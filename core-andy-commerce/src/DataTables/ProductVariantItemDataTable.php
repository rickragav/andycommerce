<?php

namespace AndyCommerce\Core\DataTables;

use AndyCommerce\Core\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.products-variant-item.edit', [Auth::user()->username, $query->id]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.products-variant-item.destroy', [Auth::user()->username, $query->id]) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
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
            ->addColumn('variant_name', function ($query) {
                return $query->productVariant->id;
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model
        ->where('variation_id',request()->variantId)
        ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariantitem-table')
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
            Column::make('color_code')
            ->addClass('text-left')
            ->width(250)
            ->title('Code'),
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
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
