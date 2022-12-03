<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <header class="py-8">
        <div class="max-w-7xl mx-auto  ">
            <h1 class="text-3xl font-bold text-white">
                <div class="flex">
                    <div class="flex-1">Posts</div>
                    <button wire:click="create_blog()" type="button"
                            class="inline-flex items-center px-5 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Post
                    </button>

                </div>
            </h1>
        </div>
    </header>
    <div class="bg-white px-4 py-4 rounded">
        <form>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                    <input type="text" wire:input="slug_generator()" name="title" wire:model="title" id="title"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           placeholder="Post Title">
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror


                @if($slug != null)
                        <div class="bg-gray-100 overflow-x-auto px-4 mt-5 rounded text-gray-400 text-sm">
                            {{url('/') .'/post/'.$slug}}
                        </div>
                    @endif
                </div>
            </div>

            <div wire:ignore class="mt-10">
                <label for="trumbowyg-demo" class="block text-sm font-medium text-gray-700">Content</label>

                <textarea  id="trumbowyg-demo" class="mt-2"></textarea>
                @error('content') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Short Description  </label>
                <div class="mt-1">
                    <textarea wire:model="shortd" rows="3" name="comment" id="comment" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                @error('shortd') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>


            <div class="sm:flex mt-10">
                <div class="sm:w-48">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" name="category"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option>Select Category</option>
                            @foreach($categorieslist as $c)
                                <option value="{{$c->id}}">{{$c->category_name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:w-56 sm:pl-10 mt-5 sm:mt-0">

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Tags</label>
                        <div class="mt-1">
                            <input type="text" wire:model="tag" wire:keydown.enter="tags()" name="tags" id="tags"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Press enter to insert tag">
                        </div>
                    </div>

                </div>
                <div class="mt-5 pl-5">

                    @foreach($selectedtags as $k =>$s )
                        <span
                            class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                 {{$s}}
                          <button type="button"
                                  class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
                            <span class="sr-only">Remove small option</span>
                            <svg wire:click="removetag('{{$k}}')" class="h-2 w-2" stroke="currentColor" fill="none"
                                 viewBox="0 0 8 8">
                              <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"/>
                            </svg>
                          </button>
                        </span>
                    @endforeach
                </div>
                <label for="file-upload" class="mt-8 relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <span class="rounded border-2 border-indigo-400 hover:border-3 p-1">Select a Post Image</span>
                    <input id="file-upload" wire:model="postimg"  name="file-upload" type="file" class="sr-only">
                </label>
            </div>

        </form>
    </div>

</div>
@push('src')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/trumbowyg.js"
            integrity="sha512-E3yEorswZX3a5irgfANe3va2uUlAXT9wf90VkHdgJ9mT/tyCdchxWPiDV+k5CVnpa3bszCjWQY3kHM+LEMmQbA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/resizimg/trumbowyg.resizimg.min.js"
            integrity="sha512-JZOoRxJ64e6kEmiOlPvfvwVHstNxfQkncJUAKUoWfUd20tyGijKV658KH0d2hgmcw0vBPNsGqu/QBs17La+nnA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/upload/trumbowyg.upload.min.js"
            integrity="sha512-tblyvFBkJg7Wlsx8tE+bj1HhrMSP4BtbeMNBoWlu2EtqZW24x52TZoP1ueepV4UbKfFz67Nsjucw++2Joju/nA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/pasteimage/trumbowyg.pasteimage.js"
            integrity="sha512-GQOXKj+eQOL6yIlEkO6KNZ48B7zz3YXplnNJa8IzA8RUcUGhC2965PU7AWAyc9zwYfHwcLmvfsslPHDf6BQZnQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/pasteembed/trumbowyg.pasteembed.js"
            integrity="sha512-zk2NgJHIz0Cz1x3Nq6TP5PTMZBLXEoCjBZJVi4lddON9hvpmPbLGDlqFcTqWZyq/vJbWHJ66mBHRuUygigLZ2w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/mathml/trumbowyg.mathml.js" integrity="sha512-CPnuMhmLvWxDQpBAAdx3wyHgmvrVTmHnlUYEmcEuOyTtujEtCwvSL9c2zLK56RZ8ozKRFdRAegx5olXmoJl2qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/giphy/trumbowyg.giphy.js"
            integrity="sha512-P6s+U80oW9EnhQfdHY1vab38FHNWYfMPINUlK5E7/PkDrskHi8ubKTA2xLfpR4iiewWrk7/vabtRpNpIgVL4Gw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/colors/trumbowyg.colors.js"
            integrity="sha512-PUoxE/Lmxp7j2FYSljuA3gaBNcICmVn+QdLBEOlM369buKWlVUWHGfX/gsfGXW+wxrDjQAVIEfdFj39bLmjXyw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/cleanpaste/trumbowyg.cleanpaste.js"
            integrity="sha512-2j0JOQmQiHkh4mG0U4IX4mZFFs7Kj9rI5SiLALJA92gV5xN/ORNYEHDqfrcqDKu389voh0Yldh9ABk/LfpD4jA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/emoji/trumbowyg.emoji.min.js"
            integrity="sha512-bGSayar7zxHjUBa0L4IaPx+192WNfAtb+2m1VMRc8nmRI+hehlikzby+MNTcgh+FbA0fLMa0GmM0IxEustPG+w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/plugins/base64/trumbowyg.base64.min.js"
            integrity="sha512-Sdq85FtYGzr64lUeG4MgN/84gn3bVUb1ffwSdJV4DNHBu0UZG/x5aQK9oyKbzdK//y4sfw7T3cNECT6xP6HyWQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function f() {
            console.log($('#trumbowyg-demo').trumbowyg('html'))


        }

        $(document).ready(function (e) {
            var tags = ['p'];

            $('#trumbowyg-demo').trumbowyg({
                btnsDef: {
                    // Create a new dropdown
                    image: {
                        dropdown: ['upload', 'insertImage'],
                        ico: 'insertImage'
                    }
                },
                btns: [
                    ['viewHTML'],

                    ['emoji'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['image'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                ],
                plugins: {
                    // Add imagur parameters to upload plugin for demo purposes
                    upload: {
                        serverPath: '{{url('/')}}' + '/api/image/new',
                        fileFieldName: 'file',


                    }
                }
            });
        })
        document.addEventListener('livewire:load', function () {
            $('#category').on('change', function (e) {
            @this.category
                = this.value;
            })
            setInterval(function (r) {

            @this.content
                = $('#trumbowyg-demo').trumbowyg('html')


            }, 500);
        })

    </script>

@endpush
