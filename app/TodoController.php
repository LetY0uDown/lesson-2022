<?php
namespace App;

class TodoController
{
    private array $config = [
        'host' => 'localhost',
        'db' => 'todoDatabase',
        'user' => 'admin',
        'pass' => 'admin'
    ];

    private TodoModel $todoModel;
    private TodoView $todoView;

    public function __construct()
    {
        $this->todoModel = new namespace\TodoModel($this->config);
        $this->todoView = new namespace\TodoView();
    }

    public function index()
    {
        $work_list = $this->todoModel->getAllWorks();
        $this->todoView->showIndex($work_list);
    }

    public function edit($id)
    {
        $work = $this->todoModel->getWorkByID($id);
        $this->todoView->showEdit($work);
    }

    public function update()
    {
        $id = $_POST['id'];
        $work = $_POST['work'];

        $this->todoModel->updateWorkData($id, $work);

        header("Location: /");
        die();
    }

    public function add()
    {
        $newWork = $_POST['work'];

        $this->todoModel->addNewWork($newWork);

        header("Location: /");
        die();
    }

    public function del($id)
    {
        $this->todoModel->delWork($id);

        header("Location: /");
        die();
    }

    public function change($id)
    {
        $work = $this->todoModel->getWorkByid($id);
        $this->todoModel->changeStatus($work);

        header("Location: /");
        die();
    }
}