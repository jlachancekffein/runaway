@extends('layouts.internal-pages')

@section('content')
    <div class="layout-container">
        <h1 class="mainTitle">{{ trans("articles.title_{$article->section}") }}</h1>

        <h2 class="sectionTitle">{{ trans("articles.edit_{$article->section}") }}</h2>

        <form class="articleForm js-articleForm" method="post" action="{{ route('articles.update', ['section' => $article->section, 'id' => $article->id]) }}" @submit.prevent="saveForm">
            {{ csrf_field() }}
            
            <div class="articleFormErrors js-articleFormErrors"></div>

            <ul class="nav nav-tabs articleForm-tabs" role="tablist">
                @foreach (config('app.available_locales') as $language)
                    <li role="presentation" class="{{ $language === 'fr' ? 'active' : '' }}">
                        <a href="#{{ $language }}" aria-controls="{{ $language }}" role="tab" data-toggle="tab">{{ trans("general.{$language}_label") }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach (config('app.available_locales') as $language)
                    <div role="tabpanel" class="tab-pane {{ $language === 'fr' ? 'active' : '' }}" id="{{ $language }}">
                        <div class="form-group">
                            <label for="titleField">{{ trans('articles.title') }}</label>
                            <input class="form-control" id="titleField" type="text" v-model="article.{{ $language }}.title">
                        </div>

                        <div class="form-group">
                            <label for="descriptionField">{{ trans('articles.description') }}</label>
                            <textarea class="form-control" id="descriptionField" v-model="article.{{ $language }}.description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="imageField">{{ trans('articles.image') }}</label>
                            <image-upload :src="article.{{ $language }}.image" upload-url="/admin/articles/blog/upload" @update="updateThumbnail" @changeState="changeState" language="{{ $language }}" label="Téléverser une image">
                        </div>

                        <fieldset>
                            <legend>{{ trans('articles.content') }}</legend>

                            <div class="blocks-toolbar">
                                <template v-for="template in templates">
                                    <button class="btn btn-default navbar-btn" @click.prevent="addBlock('{{ $language }}', template)" :data-template="'#js-block-' + template">
                                        <div v-show="template === 'blockText'">
                                            <span class="fa fa-align-left"></span>
                                            <span class="fa fa-align-left"></span>
                                        </div>
                                        <div v-show="template === 'blockImage'">
                                            <span class="fa fa-image"></span>
                                            <span class="fa fa-image"></span>
                                        </div>
                                        <div v-show="template === 'blockTextImage'">
                                            <span class="fa fa-align-left"></span>
                                            <span class="fa fa-image"></span>
                                        </div>
                                        <div v-show="template === 'blockImageText'">
                                            <span class="fa fa-image"></span>
                                            <span class="fa fa-align-left"></span>
                                        </div>
                                    </button>&nbsp;
                                </template>
                            </div>
                        </fieldset>

                        <template v-for="(block, blockIndex) in article['{{ $language }}'].content">

                            <component :is="block.templateId" language="{{ $language }}" :data="block.data" :index="blockIndex" @update="updateBlock" @state="changeState">
                            <div class="btn-group btn-group-xs">
                                <a @click="climbBlock('{{ $language }}', blockIndex)" class="btn btn-success" v-if="blockIndex !== 0"><span class="fa fa-chevron-up"></span></a>
                                <a @click="fallBlock('{{ $language }}', blockIndex)" class="btn btn-success" v-if="blockIndex !== article['{{ $language }}'].content.length - 1"><span class="fa fa-chevron-down"></span></a>
                            </div>
                            <div class="btn-group btn-group-xs">
                                <a @click="removeBlock('{{ $language }}', blockIndex)" class="btn btn-danger"><span class="fa fa-times"></span></a>
                            </div>
                            </component>

                        </template>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="statusField">{{ trans('articles.status') }}</label>
                <select class="form-control js-article-status" name="status" id="statusField"  v-model="status">
                    <option value="draft">{{ trans('articles.draft') }}</option>
                    <option value="approved">{{ trans('articles.approved') }}</option>
                </select>
            </div>

            <div class="form-group js-article-publicationDate">
                <label for="publicationDateField">{{ trans('articles.publicationDate') }}</label>
                <input class="form-control js-article-datePicker" id="publicationDateField" type="date" v-model="publication_date">
            </div>
            <a class="btn btn-danger" href="{{ route('articles.destroy', ['section' => $article->section, 'id' => $article->id]) }}" onclick="confirm('Voulez-vous vraiment supprimer ce blog ?') ? null : event.preventDefault()">Supprimer</a>
            <input class="btn btn-primary pull-right" :class="{ disabled: this.state !== 'ready' }" type="submit" value="{{ trans('articles.save') }}">
        </form>
    </div>
@endsection

@push('scripts')
<template id="blockTextTemplate">
    <div class="block blocks-template">
        <div class="blocks-header">
            <slot>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </div>
        </div>
    </div>
</template>


<template id="blockImageTemplate">
    <div class="block blocks-template">
        <div class="blocks-header">
            <slot>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dropzone :src="image0" upload-url="/admin/articles/blog/upload" @update="updateImage0Upload" @changeState="changeState" :language="language" label="Téléverser une image">
            </div>
            <div class="col-md-6">
                <dropzone :src="image1" upload-url="/admin/articles/blog/upload" @update="updateImage1Upload" @changeState="changeState" :language="language" label="Téléverser une image">
            </div>
        </div>
    </div>
</template>

<template id="blockTextImageTemplate">
    <div class="block blocks-template">
        <div class="blocks-header">
            <slot>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <dropzone :src="image" upload-url="/admin/articles/blog/upload" @update="updateImageUpload" @changeState="changeState" :language="language" label="Téléverser une image">
            </div>
        </div>
    </div>
</template>

<template id="blockImageTextTemplate">
    <div class="block blocks-template">
        <div class="blocks-header">
            <slot>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dropzone :src="image" upload-url="/admin/articles/blog/upload" @update="updateImageUpload" @changeState="changeState" :language="language" label="Téléverser une image">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </div>
        </div>
    </div>
</template>


<template id="dropzoneTemplate">
    <div class="dropzoneBlock">
        <label class="dropzoneBlock-label" :class="{ 'dropzoneBlock-label-withImage': file }" :for="_uid">
            <template v-if="file"><img :src="file" style="max-width: 100%;"></template>
            <template v-else>@{{ label }}</template>
        </label>
        <input type="hidden" v-model="file">
        <input class="dropzoneBlock-input" :id="_uid" @change="fileChange" type="file" v-show="!file" :value="inputFile">
    </div>
</template>


<template id="imageUploadTemplate">
    <div class="imageUpload">
        <label class="imageUpload-label" :for="_uid">
            <template v-if="file"><img :src="file" style="max-width: 300px;"></template>
            <template v-else><span class="btn btn-primary">@{{ label }}</span></template>
        </label>
        <input type="hidden" v-model="file">
        <input :id="_uid" @change="fileChange" type="file" :value="inputFile" style="display: none;">
    </div>
</template>


<script>
    Vue.component('blockText', {
        template: '#blockTextTemplate',
        props: ['data', 'index', 'language'],
        data: function () {
            return {
                simpleMDE: []
            };
        },
        watch: {
            data: function () {
                for (var i = 0; i < this.simpleMDE.length; i++) {
                    if (this.simpleMDE[i].value() !== this.data['text' + i]) {
                        this.simpleMDE[i].value(this.data['text' + i]);
                    }
                }
            }
        },
        mounted: function () {
            var textareas = this.$el.querySelectorAll('textarea'),
                self = this;

            for (var i = 0; i < textareas.length; i++) {
                this.simpleMDE[i] = new SimpleMDE({
                    element: textareas[i],
                    spellChecker: false,
                    status: false,
                    forceSync: true
                });

                this.simpleMDE[i].codemirror.on('change', function () {
                    self.$emit('update', self.language, self.index, {
                        text0: self.simpleMDE[0].value(),
                        text1: self.simpleMDE[1].value()
                    });
                });
            }

            for (var j = 0; j < this.simpleMDE.length; j++) {
                this.simpleMDE[j].value(this.data['text' + j]);
            }
        }
    });


    Vue.component('blockImage', {
        template: '#blockImageTemplate',
        props: ['data', 'index', 'language'],
        data: function () {
            return {
                image0: this.data.image0,
                image1: this.data.image1
            };
        },
        methods: {
            updateImage0Upload: function (value) {
                this.image0 = value;
            },
            updateImage1Upload: function (value) {
                this.image1 = value;
            },
            changeState: function (value) {
                this.$emit('changeState', value);
            }
        },
        watch: {
            image0: function (value) {
                this.$emit('update', this.language, this.index, {
                    image0: value,
                    image1: this.image1
                });
            },
            image1: function (value) {
                this.$emit('update', this.language, this.index, {
                    image0: this.image0,
                    image1: value
                });
            },
            data: function () {
                this.image0 = this.data.image0;
                this.image1 = this.data.image1;
            }
        }
    });


    Vue.component('blockTextImage', {
        template: '#blockTextImageTemplate',
        props: ['data', 'index', 'language'],
        data: function () {
            return {
                simpleMDE: null,
                image: this.data.image
            };
        },
        methods: {
            updateImageUpload: function (value) {
                this.image = value;
            },
            changeState: function (value) {
                this.$emit('changeState', value);
            }
        },
        watch: {
            image: function (value) {
                this.$emit('update', this.language, this.index, {
                    text: this.simpleMDE.value(),
                    image: value
                });
            },
            data: function () {
                if (this.simpleMDE.value() !== this.data.text) {
                    this.simpleMDE.value(this.data.text);
                }
                this.image = this.data.image;
            }
        },
        mounted: function () {
            var self = this;

            this.simpleMDE = new SimpleMDE({
                element: this.$el.querySelector('textarea'),
                spellChecker: false,
                status: false,
                forceSync: true
            });

            this.simpleMDE.codemirror.on('change', function () {
                self.$emit('update', self.language, self.index, {
                    text: self.simpleMDE.value(),
                    image: self.image
                });
            });

            this.simpleMDE.value(this.data.text);
        }
    });


    Vue.component('blockImageText', {
        template: '#blockImageTextTemplate',
        props: ['data', 'index', 'language'],
        data: function () {
            return {
                simpleMDE: null,
                image: this.data.image
            };
        },
        methods: {
            updateImageUpload: function (value) {
                this.image = value;
            },
            changeState: function (value) {
                this.$emit('changeState', value);
            }
        },
        watch: {
            image: function (value) {
                this.$emit('update', this.language, this.index, {
                    text: this.simpleMDE.value(),
                    image: value
                });
            },
            data: function () {
                if (this.simpleMDE.value() !== this.data.text) {
                    this.simpleMDE.value(this.data.text);
                }
                this.image = this.data.image;
            }
        },
        mounted: function () {
            var self = this;

            this.simpleMDE = new SimpleMDE({
                element: this.$el.querySelector('textarea'),
                spellChecker: false,
                status: false,
                forceSync: true
            });

            this.simpleMDE.codemirror.on('change', function () {
                self.$emit('update', self.language, self.index, {
                    text: self.simpleMDE.value(),
                    image: self.image
                });
            });

            this.simpleMDE.value(this.data.text);
        }
    });


    Vue.component('dropzone', {
        template: '#dropzoneTemplate',
        props: ['src', 'label', 'uploadUrl', 'language'],
        data: function () {
            return {
                file: this.src,
                inputFile: ''
            };
        },
        methods: {
            fileChange: function (event) {
                if (typeof event.target.files[0] === 'undefined') {
                    return;
                }

                var formData = new FormData(),
                    self = this;

                formData.append('file', event.target.files[0]);
                formData.append('_token', document.getElementsByName('_token')[0].value);

                this.$emit('changeState', 'upload');

                this.$http.post(this.uploadUrl, formData).then(function (response) {
                    self.file = response.body.path;
                    self.$emit('changeState', 'ready');
                });
            }
        },
        watch: {
            file: function (value) {
                this.$emit('update', value);

                if (!value) {
                    this.inputFile = '';
                }
            },
            src: function () {
                this.file = this.src;
            }
        }
    });


    Vue.component('imageUpload', {
        template: '#imageUploadTemplate',
        props: ['src', 'label', 'uploadUrl', 'language'],
        data: function () {
            return {
                file: this.src,
                inputFile: ''
            };
        },
        methods: {
            fileChange: function (event) {
                if (typeof event.target.files[0] === 'undefined') {
                    return;
                }

                var formData = new FormData(),
                    self = this;

                formData.append('file', event.target.files[0]);
                formData.append('_token', document.getElementsByName('_token')[0].value);

                this.$emit('changeState', 'upload');

                this.$http.post(this.uploadUrl, formData).then(function (response) {
                    self.file = response.body.path;
                    self.$emit('changeState', 'ready');
                });
            }
        },
        watch: {
            file: function (value) {
                this.$emit('update', this.language, value);
            },
            src: function () {
                this.file = this.src;
            }
        }
    });


    new Vue({
        el: '.js-articleForm',

        data: function () {
            var article = {};

            for (var i = 0; i < availableLocales.length; i++) {
                article[availableLocales[i]] = {
                    title: '',
                    description: '',
                    image: '',
                    content: []
                };
            }

            return {
                templates: ['blockText', 'blockImage', 'blockTextImage', 'blockImageText'],
                article: article,
                state: 'ready',
                status: 'draft',
                section: '{{ $article->section }}',
                publication_date: ''
            };
        },

        methods: {
            updateBlock: function (language, index, value) {
                this.article[language].content[index].data = value;
            },
            updateThumbnail: function (language, value) {
                this.article[language].image = value;
            },
            addBlock: function (language, templateId) {
                this.article[language].content.push({
                    templateId: templateId,
                    data: {}
                });
            },
            removeBlock: function (language, blockIndex) {
                this.article[language].content.splice(blockIndex, 1);
            },
            climbBlock: function (language, blockIndex) {
                this.article[language].content.splice(blockIndex - 1, 0, this.article[language].content.splice(blockIndex, 1)[0]);
            },
            fallBlock: function (language, blockIndex) {
                this.article[language].content.splice(blockIndex + 1, 0, this.article[language].content.splice(blockIndex, 1)[0]);
            },
            saveForm: function () {
                var self = this,
                    article = JSON.parse(JSON.stringify(this.article));

                article._token = this.$el.querySelector('[name=_token]').value;
                article.status = this.status;
                article.publication_date = this.publication_date;
                article.section = this.section;
                
                if (this.state === 'ready') {
                    this.state = 'saving';
                    this.$http.put(this.$el.action, article).then(function (response) {
                        self.state = 'ready';

                        if (typeof response.body.redirect !== 'undefined') {
                            document.location = response.body.redirect;
                        }
                    }, function (response) {
                        $(".js-articleFormErrors").html("");
                        
                        if (Object.keys(response.body).length) {
                            this.state = 'ready';
                            $.each(response.body, function(key, value) {
                                $(".js-articleFormErrors").append("<div>"+value+"</div>");
                            });
                            scrollToElement($(".js-articleFormErrors"));
                        }
                    });
                }
            },
            changeState: function (state) {
                this.state = state;
            }
        },

        created: function () {
            this.article.fr.title = "{!! addslashes($article->getTranslation('fr')->title) !!}";
            this.article.en.title = "{!! addslashes($article->getTranslation('en')->title) !!}";

            this.article.fr.description = "{!! addslashes($article->getTranslation('fr')->description) !!}";
            this.article.en.description = "{!! addslashes($article->getTranslation('en')->description) !!}";

            this.article.fr.image = "{!! addslashes($article->getTranslation('fr')->image) !!}";
            this.article.en.image = "{!! addslashes($article->getTranslation('en')->image) !!}";

            this.article.fr.content = {!! $article->getTranslation('fr')->content !!};
            this.article.en.content = {!! $article->getTranslation('en')->content !!};

            this.status = "{!! addslashes($article->status) !!}";
            this.publication_date = "{!! addslashes($article->publication_date) !!}";
        }
    });
</script>
@endpush