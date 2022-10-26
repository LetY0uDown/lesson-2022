<?php

namespace App;

class TodoView
{
    public function showIndex(array $work_list)
    {
        include 'templates/header.php';

        $form = $this->showForm('/add', 'Add new work');

        echo $this->getRow($form);
        $list  = $this->generateHtmlWorkList($work_list);
        echo $this->getRow($list);

        include 'templates/footer.php';
    }

    public function showEdit(array $work)
    {
        include 'templates/header.php';

        $hiddenValues = [
            'id' => $work['id']
        ];

        $form = $this->showForm (
            '/update',
            'Редактирование',
            $work['work_name'],
            $hiddenValues
        );

        echo $this->getRow($form);

        include 'templates/footer.php';
    }

    public function getRow(string $content) : string
    {
        $html = '<div class="row my-2"><div class="col">';
        $html .= $content;
        $html .= '</div></div>';

        return $html;
    }

    public function showForm(string $action, string $title, string $value = '', array $hidden = []) : string
    {
        $form = '<div class="card"><div class="card-body"><h4 class="card-title">';
        $form .= $title;
        $form .= '</h4><form action="'.$action.'" method="post">';

        $form .= '<div class="form-group">';
        $form .= '<input type="text" class="form-control" name="work" value="'.$value.'">';
        $form .= '</div>';

        if(!empty($hidden)) {
            foreach ($hidden as $key => $value) {
                $form .= '<input type="hidden" class="form-control" name="'.$key;
                $form .= '" value="'.$value.'">';
            }
        }

        $form .= '<button type="submit" name="btnWork" class="btn btn-primary">';
        $form .= 'Submit</button></form></div></div>';

        return $form;
    }

    public function generateHtmlWorkList(array $workList) : string
    {
        $html = '';

        foreach ($workList as $row) {
            $background = $row['work_status'] == 0 ? '#ffbbbb'
                                                   : '#bbffbb';

            $html .= '<li class="list-group-item" style="background-color: '.$background.'; margin-top: 5px;">';

            $id = $row['id'];

            $html .= $this->getIconLink('change/'.$id,  'fas fa-check-circle',  'success');
            $html .= $this->getIconLink('edit/'.$id,    'fas fa-pen',           'primary');
            $html .= $this->getIconLink('del/'.$id,     'fas fa-trash-alt',     'danger');

            $html .= '<span style="margin-left: 15px; font-weight: bold;">'.$row['work_name'].'</span>';
        }

        return $html;
    }

    private function getIconLink(string $action, string $icon, string $color) : string
    {
        $html = '<a href="'.$action.'" class="btn btn-outline-'.$color.' btn-sm" style="margin: 5px;">';
        $html .= '<i class="'.$icon.'"></i></a>';

        return $html;
    }
}