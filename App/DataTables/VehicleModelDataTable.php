<?php

/**
 * VehicleModel DataTable
 *
 * @package     Ridein
 * @subpackage  DataTable
 * @category    VehicleModel
 * @author      Source Monster Team
 * @version     3.0.1
 * @link        https://sourcemonster.in
 */

namespace App\DataTables;

use App\Models\VehicleModel;
use Yajra\DataTables\Services\DataTable;
use DB;

class VehicleModelDataTable extends DataTable
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
            ->of($query)
            ->addColumn('vehicle_make_id', function ($vehicle_model) {
                return $vehicle_model->vehicle_make->make_name;
            })
            ->addColumn('action', function ($vehicle_model) {
                $edit = (auth('admin')->user()->can('update_vehicle_model')) ?  '<a href="'.url('admin/edit-vehicle_model/'.$vehicle_model->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;' : '';
                $delete = (auth('admin')->user()->can('delete_vehicle_model')) ?  '<a data-href="'.url('admin/delete_vehicle_model/'.$vehicle_model->id).'" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>': '';

                return $edit.$delete;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param VehicleModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VehicleModel $model)
    {
        return $model->all();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->addAction()
                    ->minifiedAjax()
                    ->dom('lBfr<"table-responsive"t>ip')
                    ->orderBy(0)
                    ->buttons(
                        ['csv', 'excel', 'print', 'reset']
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id' , 'title' => __('messages.admin.manage_vehicle_model.table.id')],
            ['data' => 'vehicle_make_id' , 'title' => __('messages.admin.manage_vehicle_model.table.make')],
            ['data' => 'model_name' , 'title' => __('messages.admin.manage_vehicle_model.table.model')],
            ['data' => 'status' , 'title' => __('messages.admin.manage_vehicle_model.table.status')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'VehicleModel_' . date('YmdHis');
    }
}
