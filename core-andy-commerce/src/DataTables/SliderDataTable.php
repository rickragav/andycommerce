<?php

namespace AndyCommerce\Core\DataTables;

use AndyCommerce\Core\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.slider.edit', ['username' => Auth::user()->username, 'slider' => $query->id]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.slider.destroy', ['username' => Auth::user()->username, 'slider' => $query->id]) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('banner', function ($query) {
                return $img = "<img width='100px' src='" . asset($query->banner) . "' ></img>";
            })
            ->addColumn('status', function ($query) {
                $active = '<i class="badge badge-success">Active</i>';
                $inActive = '<i class="badge badge-danger">Inactive</i>';

                if ($query->status == '1') {
                    return $active;
                } else {
                    return $inActive;
                }
            })
            ->rawColumns(['banner', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
       return $model->newQuery();
       //return $model->newQuery()->where('shopper_id', Auth::user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([Button::make('excel'), Button::make('csv'), Button::make('pdf'), Button::make('print'), Button::make('reset'), Button::make('reload')]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(50)->addClass('text-left'),
            Column::make('banner')->width(80)->addClass('text-left'),
            Column::make('title')->addClass('text-left'),
            Column::make('description')->addClass('text-left'),
            Column::make('serial')->addClass('text-left'),
            Column::make('status')->addClass('text-left'),
            Column::computed('action')->exportable(false)->printable(false)->width(200)->addClass('text-left'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
