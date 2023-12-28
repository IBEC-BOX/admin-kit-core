@php
    use Filament\Support\Facades\FilamentView;

    $hasInlineLabel = $hasInlineLabel();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $rows = $getRows();
    $shouldAutosize = $shouldAutosize();
    $statePath = $getStatePath();
    $fieldName = substr($statePath, strpos($statePath, ".") + 1);
    $initialHeight = (($rows ?? 2) * 1.5) + 0.75;
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
        :has-inline-label="$hasInlineLabel"
>
    <x-slot
            name="label"
            @class([
                'sm:pt-1.5' => $hasInlineLabel,
            ])
    >
        {{ $getLabel() }}
    </x-slot>

    <x-filament::input.wrapper
            :disabled="$isDisabled"
            :valid="! $errors->has($statePath)"
            :attributes="
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['fi-fo-textarea overflow-hidden'])
        "
    >
        <div x-data="{ state: $wire.$entangle('name') }" wire:ignore>
            <textarea
                    id="editor"
                    @if ($shouldAutosize)
                        @if (FilamentView::hasSpaMode())
                            ax-load="visible"
                    @else
                        ax-load
                    @endif
                    ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('textarea', 'filament/forms') }}"
                    x-data="textareaFormComponent({ initialHeight: @js($initialHeight) })"
                    x-ignore
                    x-intersect.once="render()"
                    x-on:input="render()"
                    x-on:resize.window="render()"
                {{ $getExtraAlpineAttributeBag() }}
                    @endif
                    {{
                        $getExtraInputAttributeBag()
                            ->merge([
                                'autocomplete' => $getAutocomplete(),
                                'autofocus' => $isAutofocused(),
                                'cols' => $getCols(),
                                'disabled' => $isDisabled,
                                'id' => $getId(),
                                'maxlength' => (! $isConcealed) ? $getMaxLength() : null,
                                'minlength' => (! $isConcealed) ? $getMinLength() : null,
                                'placeholder' => $getPlaceholder(),
                                'readonly' => $isReadOnly(),
                                'required' => $isRequired() && (! $isConcealed),
                                'rows' => $rows,
                                $applyStateBindingModifiers('wire:model') => $statePath,
                            ], escape: false)
                            ->class([
                                'block w-full border-none bg-transparent px-3 py-1.5 text-base text-gray-950 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6',
                                'resize-none' => $shouldAutosize,
                            ])
                            ->style([
                                "height: {$initialHeight}rem" => $shouldAutosize,
                            ])
                    }}
        >    {{ $getRecord()->$fieldName }}</textarea>
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/super-build/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/super-build/translations/ru.js"></script>
<script src="{{asset('/js/ckfinder/ckfinder.js')}}"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        // extraPlugins: [CKFinder],
        // plugins: [CKFinder],
        toolbar: {
            items: [
                'undo', 'redo',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight:yellowMarker', 'highlight:greenMarker', 'highlight:pinkMarker', 'highlight:blueMarker', 'removeHighlight', '|',
                'alignment', '|',
                'link', 'blockQuote', 'insertTable', 'mediaEmbed', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', '|',
                'sourceEditing', 'ckfinder'
            ],
            shouldNotGroupWhenFull: true
        },
        ckfinder: {
            uploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
            browseUrl: '{{ route('ckfinder_browser') }}',
            options: {
                resourceType: 'Images'
            },
            openerMethod: 'modal'
        },
        table: {
            contentToolbar: [
                'tableColumn', 'tableRow', 'mergeTableCells',
                'tableProperties', 'tableCellProperties'
            ],

            // Configuration of the TableProperties plugin.
            tableProperties: {
                // ...
            },

            // Configuration of the TableCellProperties plugin.
            tableCellProperties: {
                // ...
            }
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        language: 'ru',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'editor',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in a new tab',
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                },
                //     defaultProtocol: 'https://',
                //     toggleDownloadable: {
                //       mode: 'manual',
                //       label: 'Downloadable',
                //       attributes: {
                //         download: 'file'
                //       }
                //     }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            // 'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ],
    })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set("{{$statePath}}", editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
</script>