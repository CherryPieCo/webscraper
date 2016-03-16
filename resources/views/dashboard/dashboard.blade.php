@extends('admin::layouts.default')

@section('headline')
    <div> 
        <h1>Oh hai</h1>
    </div>
@stop

@section('main')
<div id="content">
<section>
    <div class="row">
        <div class="widget-body">
            <form id="urls-form" onsubmit="App.sendUrls(); return false;" action="/admin" method="post" id="comment-form" class="smart-form" novalidate="novalidate">
                <fieldset>
                    <section>
                        <label class="label">Urls</label>
                        <label class="textarea"> 
                            <textarea rows="4" name="urls"></textarea> 
                        </label>
                    </section>
                    
                    <section>
                        <label class="label">Parsers:</label>
                        
                        
                        <div class="row">
                            <div class="col col-2">
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[email]" checked="checked">
                                    <i></i>Email / Contact</label>
                            </div>
                            <div class="col col-2">
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[moz][options][page_authority]">
                                    <i></i>MOZ (page authority)</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[moz][options][domain_authority]">
                                    <i></i>MOZ (domain authority)</label>
                            </div>
                            <div class="col col-2">
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[pages][options][advertising]">
                                    <i></i>Pages (advertising)</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[pages][options][useful]">
                                    <i></i>Pages (useful)</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[pages][options][donate]">
                                    <i></i>Pages (donate)</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[pages][options][blog]">
                                    <i></i>Pages (blog)</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="parsers[pages][options][guest]">
                                    <i></i>Pages (guest)</label>
                            </div>
                        </div>
                        
                        
                    </section>
                </fieldset>
            
                <footer>
                    <button type="submit" name="submit" class="btn btn-primary">
                        GO
                    </button>
                </footer>
            </form>
        </div>
    </div>
</section>

<hr>


<div class="well">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>url</th>
                        <th>email</th>
                        <th>contacts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $url)
                    <tr>
                        <td><a href="{{ $url->url }}" target="_blank">{{ $url->url }}</a></td>
                        <td>{{ $url->email }}</td>
                        <td>
                            @foreach ($url->getContacts() as $contact)
                                <a href="{{ $contact }}" target="_blank">{{ $contact }}</a>
                                <br>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>







<script>
'use strict';

var App = 
{
    sendUrls: function()
    {
        
        jQuery.ajax({
            type: "POST",
            url: '/admin',
            data: $('#urls-form').serializeArray(),
            dataType: 'json',
            success: function(response) {
                console.log(response);
            }
        });
    }
};
</script>
@stop



@section('styles')
@stop

@section('scripts')
@stop
