@extends('layouts.admin')

@section('customScripts')
<script src="../../js/scriptFooter.js"></script>
<script src="../../js/jscolor.js"></script>
@stop

@section('sectionName')
<style>
	footer {
    color: #fff;
}

footer h3 {
    margin-bottom: 30px;
}

footer .footer-above {
    padding-top: 50px;
    background-color: #@{{bgcolor}};
}

footer .footer-col {
    margin-bottom: 50px;
}

footer .footer-below {
    padding: 25px 0;
    background-color: #@{{bgcolorBottom}};
}
.btn-social {
    display: inline-block;
    width: 50px;
    height: 50px;
    border: 2px solid #fff;
    border-radius: 100%;
    text-align: center;
    font-size: 20px;
    line-height: 45px;
}

.btn:focus,
.btn:active,
.btn.active {
    outline: 0;
}
.btn-outline {
    margin-top: 15px;
    border: solid 2px #fff;
    font-size: 20px;
    color: #fff;
    background: 0 0;
    transition: all .3s ease-in-out;
}

.btn-outline:hover,
.btn-outline:focus,
.btn-outline:active,
.btn-outline.active {
    border: solid 2px #fff;
    color: #18bc9c;
    background: #fff;
}

</style>

<footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>@{{footerLeftCaption}}</h3>
                        <p>@{{{footerLeftText}}}</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>@{{footerCentreCaption}}</h3>
                        <p>@{{{footerCentreText}}}</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>@{{footerRightCaption}}</h3>
                        <p>@{{{footerRightText}}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; @{{copyrightText}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
@stop

@section('edit')
<LABEL>Footer left caption: </LABEL><input class="form-control" v-model="footerLeftCaption">
<LABEL>Footer left text: </LABEL><input class="form-control" v-model="footerLeftText">
<LABEL>Footer centre caption: </LABEL><input class="form-control" v-model="footerCentreCaption">
<LABEL>Footer centre text: </LABEL><input class="form-control" v-model="footerCentreText">
<LABEL>Footer right caption: </LABEL><input class="form-control" v-model="footerRightCaption">
<LABEL>Footer right text: </LABEL><input class="form-control" v-model="footerRightText">
<LABEL>Copyright text: </LABEL><input class="form-control" v-model="copyrightText">
<label>Background colour: </label><input id="jscolorPicker" class="form-control jscolor" v-model="bgcolor">
<label>Background colour: </label><input id="jscolorPicker2" class="form-control jscolor" v-model="bgcolorBottom">
<pre>@{{$data | json}}</pre>
@stop

@section('scripts')

@stop