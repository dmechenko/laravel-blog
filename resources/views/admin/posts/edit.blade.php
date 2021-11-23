<x-layout>
  <x-setting :heading="'Edit Post: ' . $post->title">
    <form action="/admin/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <x-form.input name="title" :value="old('title', $post->title)"/>
      <x-form.input name="slug" :value="old('title', $post->slug)"/>
      <x-form.input name="thumbnail" type="file" :value="old('title', $post->thumbnail)"/>
      Current thumbnail: <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Blog Post illustration" class="rounded-xl" width="50">
      <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
      <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>
      <x-form.field>
        <x-form.label name="category" />
          <select name="category_id" id="category_id">
            @php
                $categories = \App\Models\Category::all();
            @endphp
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                  {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}
                  >{{ ucwords($category->name) }}</option>
            @endforeach
          </select>
        <x-form.error name="category"/>
      </x-form.field>
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 rounded text-white py-2 uppercase font-semibold px-10 hover:bg-blue-600">
            Update
        </button>
      </div>
    </form>
  </x-setting>
</x-layout>