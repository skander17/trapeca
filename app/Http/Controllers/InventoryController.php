<?php


namespace App\Http\Controllers;


use App\Models\Inventory;
use Core\Request\Request;

class InventoryController extends BaseController
{
    public $name = "Inventario";
    public function __construct()
    {
        parent::__construct(new Inventory());
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $data['productos'] = $this->model->getAll();
        return $this->view("admin/inventario",$data);
    }
}