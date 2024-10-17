<?php

namespace AndyCommerce\Core\DataTables;

use AndyCommerce\Core\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantDataTable extends DataTable
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
                $variantItems = "<a href='" . route('vendor.products-variant-item.index', [Auth::user()->username, 'variantId' => $query->id]) . "' class='btn btn-info mr-2'><i class='fas fa-plus mr-1'></i>Add values</a>";
                $editBtn = "<a href='" . route('vendor.products-variant.edit', [Auth::user()->username, $query->id]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.products-variant.destroy', [Auth::user()->username, $query->id]) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $variantItems.$editBtn . $deleteBtn;
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
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->newQuery()->where('shopper_id', Auth::user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariant-table')
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
            Column::make('id')->width(80)->addClass('text-left')->title('S/L'),
            Column::make('name')
            ->addClass('text-left')
            ->width(250)
            ->title('Name'),
            Column::make('status')
            ->addClass('text-left')
            ->width(100)
            ->title('Active'),
            Column::computed('action')->exportable(false)->printable(false)->width(300)->addClass('text-right'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariant_' . date('YmdHis');
    }
}
