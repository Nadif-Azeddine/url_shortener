@extends('layouts.app')

@section('title')
    <title>squaHR-Generate Short Url</title>
@endsection

@section('content')
    <div class="all" id="app">
        <div class="txt-img">
            <div class="img">
                <img src="{{ url('/asset/www.svg') }}" alt="illustration">
            </div>
            <div class="txt">
                <h1 class="sp-title">squahr code shortener</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat eveniet impedit quibusdam non
                    perspiciatis ad mollitia rerum dicta nisi consequuntur.</p>
            </div>
        </div>

        <div class="field">
            <form action="" method="post">
                @csrf
                <p style="color:#e23939;text-align: center">@{{ error }}</p>
                <input class="form-control" type="text" name="url" id="url" v-model="url_input" required
                    placeholder="enter the URL">
                <button class="squahr_btn" v-on:click.prevent="submit">Generate</button>
            </form>
        </div>

        {{-- the response that apear when generate the short url --}}
        <section v-if="generated" class="response">
            <div class="body">
                {{-- button to close the response --}}
                <button v-on:click="dismiss_response" id="btn_dismiss"><span>&times;</span></button>
                <img src="{{ url('/asset/www.svg') }}" alt="illust" draggable="false">
                
                <p style="color: var(--bs-success);font-weight: 600">Your Short URL is generated successfully !</p>
                <p style="font-size: .9em;margin-top: -1.1rem">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Velit, et.</p>

                {{-- the short url generated --}}
                <div >
                <a v-bind:href="short_url_gen.short_url" style="font-weight: 600">@{{ (short_url_gen != null) ? short_url_gen.short_url: "" }}</a>

                {{-- button to copy the url --}}
                <button class="mx-2" v-if="short_url_gen!=null" v-on:click="copy_url(short_url_gen.short_url)" id="btn_copy_url" title="copy short url"><i
                        class="fa fa-clipboard" aria-hidden="true"></i></button>
                    </div>
                {{-- a messgae appers after copying the short url successfully --}}
                <p style="font-size: .9em;color:var(--bs-success)" id="copy_msg"></p>
            </div>

        </section>
        <div class="stats">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem nisi officiis id sed similique facilis?</p>
            {{-- butto to get the stats and lunch the modal --}}
            <button data-bs-toggle="modal" data-bs-target="#modelId" v-on:click="get_stats"> See Statistics <i
                    class="fa fa-chart-simple "></i></button>
        </div>
        {{-- modal to show all the urls and their statistics --}}

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title">All Your Short Urls</h4>
                            <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, blanditiis?</p>
                        </div>
                        {{-- <button   type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>  --}}
                        <select  class="form-select" aria-label="Default select example">
                            <option selected>Filter By</option>
                            <option v-on:click="filter(1)">recently added</option>
                            <option v-on:click="filter(2)">most visited</option>
                        </select>
                    </div>

                    <div class="modal-body">

                        <div id="loader_stats">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <ul class="all_stat">
                            <li v-for="url in urls" class="url">
                                <div class="url_short">
                                    <p><i class="fa fa-globe" aria-hidden="true"></i> @{{ no_long_urls(url.url) }} </p>
                                    <a v-bind:href="'/'+url.short_url"
                                        style="margin-left: 5px; font-weight: 600; text-decoration: underline">@{{ url.short_url }}
                                    </a>
                                </div>
                                <div class="actions">
                                    <p>@{{ url.clicks }} <i class="fa fa-hand-pointer" aria-hidden="true"></i> </p>
                                    <button v-on:click="delete_url(url.url_id)"
                                        style="margin-left: 15px;color: var(--bs-danger)"><i
                                            class="fas fa-trash-alt    "></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        app = Vue.createApp({
            mounted() {
                this.loading()

            },
            data() {
                return {

                    url_input: null,
                    error: null,
                    generated: false,
                    short_url_gen: null,
                    urls: {},

                }

            },
            methods: {
                loading() {

                },

                get_stats() {
                    axios.post('/squahr_code_shortener/get_stats', {}).then(response => {
                        this.urls = response.data
                        $("#loader_stats").remove();

                    })

                },
                // function to write the original url in simple way
                no_long_urls(url) {
                    if (String(url).length >= 30) {
                        return String(url).substr(0, 30) + "..."

                    } else {
                        return String(url)
                    }
                },
                // send the input to generate a short url and handl the errors
                submit() {
                    // set error to null so to hide the error in the next request
                    this.error = null

                    // send a post request to generate a short url
                    axios.post('/squahr_code_shortener/generate', {
                        'url': this.url_input,
                    }).then(response => {
                        this.url_input = null
                        this.generated = true
                        this.short_url_gen = response.data.url

                    }).catch(error => {

                        // check the error status. if it is equal to 422 it means that the input is not valid
                        if (error.response.status == 422) {
                            this.error =
                                "the given input was invalid, please make sure to enter a valid url."
                        } else {
                            // handl the unexpected errors
                            this.error = "something wrong! please send it again"

                        }

                    })
                },
                // delete a url 
                delete_url(id) {
                    if (confirm('Are you sure? you want to delete this short url')) {
                        axios.post('/squahr_code_shortener/delete_url', {
                            'id': id
                        }).then(response => {
                            if (response.data = "done") {
                                this.get_stats()

                            }

                        })
                    }

                },

                // close the response
                dismiss_response() {
                    this.generated = false
                },

                // copy the short url when it generated 
                copy_url(url) {
                    navigator.clipboard.writeText(url)
                    $("#copy_msg").html(
                        'The short url copied succefully <i class="fa fa-check-circle" aria-hidden="true"></i>');
                    $("#btn_copy_url").remove();

                },

                // filter the urls 
                filter(opt){
                    axios.post('/squahr_code_shortener/filter', {
                            'option': opt
                        }).then(response => {  
                            console.log(response)   
                                this.urls = response.data     

                        })
                    
                },


            },
        })
        app.mount("#app")
    </script>
@endsection
