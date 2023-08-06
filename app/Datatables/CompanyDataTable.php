<?php

namespace App\DataTables;

use App\Models\Company;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                if($data->logo)
                {
                    return $data->name.
                    '<br/><br/><img src="'.asset($data->logo).'" alt="'.$data->company_name.'" width="80">';
                }
                else
                {
                    return $data->name;
                }
            })
            ->addColumn('action', function ($data) {
                return view('components.action', [
                    'no_action' => $this->no_action ?? null,
                    'update' => [
                        'route' => route('companies.edit', ['company' => $data->id]),
                    ],
                    'delete' => [
                        'route' => route('companies.destroy', ['company' => $data->id]),
                    ],
                    'data' => $data,
                ])
                    ->render();
            })
            ->filter(function ($query) {
                // Custom search filter for the 'name' column
                if (request()->has('search')) {
                    $keyword = request('search')['value'];
                    $query->whereRaw("LOWER(name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("LOWER(email) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("LOWER(website) LIKE ?", ["%{$keyword}%"]);
                }
            })
            ->orderColumn('name', function ($query, $order) {
                // Handle sorting for the 'name' column
                $query->orderBy('name', $order);
            })
            ->rawColumns(['action', 'name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('company-table')
            ->addTableClass('table w-100 table-hover')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc')
            ->responsive()
            ->autoWidth()
            ->stateSave()
            ->searching(true)
            ->processing(false);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex', trans('labels.no')),
            Column::make('name')->title(trans('labels.name')),
            Column::make('email')->title(trans('labels.email')),
            Column::make('website')->title(trans('labels.website')),
            Column::computed('action', trans('labels.action'))->addClass('text-center')
        ];
    }
}