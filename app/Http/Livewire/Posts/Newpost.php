<?php

namespace App\Http\Livewire\Posts;

use App\Models\post_categories;
use App\Models\posts;
use Livewire\Component;
use Livewire\WithFileUploads;

class Newpost extends Component
{
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
        'postimg' => 'image'

    ];

    protected $messages = [
        'title.required' => 'Title is required for blog post.',
        'shortd.required' => 'Short Description is required for blog post.',
        'postimg.required' => 'Featured Image is required for blog post.',

    ];

    public function mount()
    {
        $this->categorieslist = post_categories::where('enabled',
            true)->get();
    }


    public function render()
    {
        return view('livewire.posts.newpost');
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

    public function create_blog()
    {
        $this->validate();
        $filename = explode('.', str_replace(' ', '_', $this->postimg->getClientOriginalName()))[0] . rand(1, 199999) . time() . '.' . $this->postimg->getClientOriginalExtension();
        $this->postimg->storeAs('images/posts/' . date('Y'), $filename, 'public');
        posts::create([
            'title' => $this->title,
            'content' => $this->content,
            'short_content' => $this->shortd,
            'category' => $this->category,
            'featured_image' => $filename,
            'published' => 0,
            'tags' => json_encode($this->selectedtags),
            'slug' => $this->slug
        ]);
       return $this->redirect(route('post.edit'));
    }

}
