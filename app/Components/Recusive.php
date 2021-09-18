<?php

namespace App\Components;


class Recusive
{

    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;

    }

    public  function categoryRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            // nếu là danh mục con thì hiển thị
            if ($value['parent_id'] == $id) {
                // xử lý cho eidt: tìm xem cái nào có value['id'] bằng $parentId truyền lên
                // thì select k thì cứ list ra các thẻ option

                // ở trường add: thì auto nó trường parent_id = 0 rồi nên kb giờ có select đc vì id bắt đầu từ 1
                if ( !empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }

                $this->categoryRecusive($parentId, $value['id'], $text. '--');
            }
        }

        return $this->htmlSelect;

    }



}