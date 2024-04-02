<?php

namespace App\DataTables;

use App\Models\Level;
use App\Models\LevelModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LevelDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'level.action')
            // ->addColumn('action', function ($data) {
            //     $editUrl = route('user.edit', $data->user_id);
            //     $deleteUrl = route('user.delete', $data->user_id);

            //     return "<a href='{$editUrl}' class='btn btn-sm btn-warning'>Edit</a>
            //     <form action='{$deleteUrl}' method='POST' style='display:inline'>"
            //         . method_field('DELETE') . csrf_field() . "
            //         <button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure want to delete {$data->username}?\")'>Delete</button>
            //     </form>";
            // })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LevelModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('level-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('level_id'),
            Column::make('level_kode'),
            Column::make('level_nama'),
            Column::make('created_at'),
            Column::make('updated_at'),
            // Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Level_' . date('YmdHis');
    }
}
