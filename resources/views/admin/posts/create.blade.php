<x-layout>
  <x-setting heading="Publish New Post">
    <form action="/admin/posts" method="post" enctype="multipart/form-data">
      @csrf
      <x-form.input name="title"/>
      <x-form.input name="slug"/>
      <x-form.input name="thumbnail" type="file"/>
      <x-form.textarea name="excerpt" />
      <x-form.textarea name="body" />
      <x-form.field>
        <x-form.label name="category" />
          <select name="category_id" id="category_id">
            @php
                $categories = \App\Models\Category::all();
            @endphp
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                  {{ old('category_id') == $category->id ? 'selected' : ''}}
                  >{{ ucwords($category->name) }}</option>
            @endforeach
          </select>
        <x-form.error name="category"/>
      </x-form.field>
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 rounded text-white py-2 uppercase font-semibold px-10 hover:bg-blue-600">
            Publish
        </button>
      </div>
    </form>
  </x-setting>
</x-layout>