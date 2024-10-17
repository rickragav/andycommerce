<?php

namespace AndyCommerce\Core\DataTables;

use AndyCommerce\Core\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('vendor.brand.edit', [Auth::user()->username, $query->id]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.brand.destroy', [Auth::user()->username, $query->id]) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('logo', function (Brand $brand) {
                return $img = "<img width='100px' src='" . asset($brand->logo) . "' ></img>";
            })
            ->addColumn('is_featured', function ($query) {
                $active = '<i class="badge badge-success">Yes</i>';
                $inActive = '<i class="badge badge-danger">NO</i>';

                if ($query->is_featured == '1') {
                    return $active;
                } else {
                    return $inActive;
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button =
                        '<label class="custom-switch mt-2">
                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="' .
                        $query->id .
                        '" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>

                  </label>';
                } else {
                    $button =
                        '<label class="custom-switch mt-2">
                    <input type="checkbox"  name="custom-switch-checkbox" data-id="' .
                        $query->id .
                        '" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>

                  </label>';
                }
                return $button;
            })
            ->rawColumns(['logo', 'is_featured', 'status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery()->where('shopper_id', Auth::user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([Button::make('excel'), Button::make('csv'), Button::make('pdf'), Button::make('print'), Button::make('reset'), Button::make('reload')]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('text-left'),
            Column::make('logo')->addClass('text-left')->width(200),
            Column::make('name')->addClass('text-left')->width(300),
            Column::make('status')->addClass('text-left'),
            Column::make('is_featured')->addClass('text-left'),
            Column::computed('action')->exportable(false)->printable(false)->width(200)->addClass('text-left')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
