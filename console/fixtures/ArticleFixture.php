<?php

class ArticleFixture {

    public function load(){
        for($i=1; $i<10; $i++){
            $art = new Article();
            $art->content = 'article content - #'.$i;
            $art->short_content = 'short content '.$i;
            $art->name = 'article - #'.$i;
            $art->is_visible = 1;
            $art->created_at = date('Y-m-d H:i:s');
            $art->updated_at = date('Y-m-d H:i:s');
            
            $art->save();
        }
    }

}
