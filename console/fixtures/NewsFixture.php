<?php

class NewsFixture {

    public function load(){
        for($i=1; $i<10; $i++){
            $art = new News();
            $art->content = 'new content - #'.$i;
            $art->short_content = 'new content '.$i;
            $art->name = 'new - #'.$i;

            $art->is_visible = 1;
            $art->created_at = date('Y-m-d H:i:s');
            $art->updated_at = date('Y-m-d H:i:s');
        }
    }

}
