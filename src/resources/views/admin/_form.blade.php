<div class="header">
    @include('core::admin._button-back', ['url' => $model->indexUrl(), 'title' => __('Things')])
    @include('core::admin._title', ['default' => __('New thing')])
    @component('core::admin._buttons-form', ['model' => $model])
    @endcomponent
</div>

<div class="content">
    @include('core::admin._form-errors')

    <file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
    <file-field type="image" field="og_image_id" :init-file="{{ $model->ogImage ?? 'null' }}" label="Open Graph image"></file-field>
    <files-field :init-files="{{ $model->files }}"></files-field>

    @include('core::form._title-and-slug')
    <div class="mb-3">
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    </div>
    {!! TranslatableBootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
    <x-core::tiptap-editors :model="$model" name="body" :label="__('Body')" />
</div>
