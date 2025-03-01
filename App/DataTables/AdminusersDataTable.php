<?php

/**
 * Admin Users DataTable
 *
 * @package     Ridein
 * @subpackage  DataTable
 * @category    Admin Users
 * @author      Source monster Team
 * @version     3.0.1
 * @link        https://sourcemonster.in
 */

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Admin;
use DB;

class AdminusersDataTable extends DataTable
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
            ->addColumn('action', function ($admin) {
                $edit = '<a href="'.url('admin/edit_admin_users/'.$admin->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;';
                $delete = '<a data-href="'.url('admin/delete_admin_user/'.$admin->id).'" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';
                return $edit.$delete;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
   	return $model->all()->whereNotIn('username', rideinuser());
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
                    ->minifiedAjax()
                    ->dom('lBfr<"table-responsive"t>ip')
                    ->orderBy(0,'ASC')
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
            ['data' => 'id', 'name' => 'id', 'title' => __('messages.admin.manage_admin_page.table.id')],
            ['data' => 'username', 'name' => 'username', 'title' =>  __('messages.admin.manage_admin_page.table.username')],
            ['data' => 'email', 'name' => 'email', 'title' =>  __('messages.admin.manage_admin_page.table.email')],
            ['data' => 'status', 'name' => 'status', 'title' =>  __('messages.admin.manage_admin_page.table.status')],
            ['data' => 'action', 'name' => 'action', 'title' =>  __('messages.admin.manage_admin_page.table.action'), 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    public function filename(): string
    {
        return 'admin_users_' . date('YmdHis');
    }
}