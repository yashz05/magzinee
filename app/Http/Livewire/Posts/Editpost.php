<?php

namespace App\Http\Livewire\Posts;

use App\Models\post_categories;
use App\Models\posts;
use Livewire\Component;
use Livewire\WithFileUploads;

class Editpost extends Component
{
    public $idf;
    public $t = false;
    public $title;
    public $slug;
    public $content;
    public $categorieslist;
    public $selectedtags = [];
    public $tag;
    public $category = 0;
    public $postimg;
    public $shortd;
    use WithFileUploads;

    protected $rules = [
        'title' => 'required|min:6',
        'content' => 'required',
        'shortd' => 'required',


    ];

    protected $messages = [
        'title.required' => 'Title is required for blog post.',
        'shortd.required' => 'Short Description is required for blog post.',
        'postimg.required' => 'Featured Image is required for blog post.',

    ];
    public function render()
    {
        return view('livewire.posts.editpost');
    }
    public function mount()
    {
        $data =  posts::where('id',$this->idf)->first();
        if($data == null){
              abort(404, "The Partner was not found");
        }else{
            $this->title = $data->title;
            $this->slug=$data->slug;
            $this->content = $data->content;
            $this->category=$data->category;
            $this->selectedtags = $data->tags;
            $this->shortd = $data->short_content;


        }
        $this->categorieslist = post_categories::where('enabled',
            true)->get();
    }
    public function slug_generator()
    {

        $this->slug = str_replace(" ",
            "_",
            $this->title);

    }

    public function tags()
    {
        array_push($this->selectedtags, $this->tag);
        $this->tag = null;
    }

    public function removetag($i)
    {
        unset($this->selectedtags[$i]);

    }

    public function update_post()
    {


   $this->validate();
        if($this->postimg != null){
            $filename = explode('.', str_replace(' ', '_', $this->postimg->getClientOriginalName()))[0] . rand(1, 199999) . time() . '.' . $this->postimg->getClientOriginalExtension();
            $this->postimg->storeAs('images/posts/' . date('Y'), $filename, 'public');
            posts::where('id',$this->idf)->update([
                'title' => $this->title,
                'content' => $this->content,
                'short_content' => $this->shortd,
                'category' => $this->category,
                'featured_image' => $filename,
                'published' => 0,
                'tags' => json_encode($this->selectedtags),
                'slug' => $this->slug
            ]);
        }else{
            posts::where('id',$this->idf)->update([
                'title' => $this->title,
                'content' => $this->content,
                'short_content' => $this->shortd,
                'category' => $this->category,

                'published' => 0,
                'tags' => json_encode($this->selectedtags),
                'slug' => $this->slug
            ]);
        }
            $this->emit('toast', "Post Updated");


        //        return $this->redirect(route('post.edit'));
    }

}
