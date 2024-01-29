import "./bootstrap";
import $ from "jquery";
import validate from "jquery-validation";
import Swal from "sweetalert2";

$(function () {
    $("[data-generate-pokemon]").on("click", function (event) {
        event.preventDefault();
        $(this).css("display", "none");
        $("[data-generate-pokemon-loading]").css("display", "block");
        let url = decodeURIComponent(parametersJs.routes.generate);
        $.ajaxExecute({
            type: "GET",
            url: url,
            sweetalert: false,
            funcao: handleSweetAlert,
        });
    });
});

$(function () {
    $("[data-update-pokemon-name]").on("click", function (event) {
        event.preventDefault();
        let pokemonId = $(this).data("pokemon-id");
        let url = decodeURIComponent(parametersJs.routes.update);
        let data = {
            name: $(`[data-pokemon-new-name-${pokemonId}]`).val(),
            _token: $(this).data("token"),
        };
        $(`[data-pokemon-name-${pokemonId}]`).text(data.name);
        url = url.replace("[POKEMON_ID]", pokemonId);
        $.ajaxExecute({
            type: "PUT",
            data: data,
            url: url,
            sweetalert: false,
            funcao: handleSweetAlert,
        });
    });
});

function handleSweetAlert(response) {
    let icon = response.type ? "success" : "error";
    let btnMessage = response.data.btnText ? response.data.btnText : "Fechar";
    if (response.data.pokemon) {
        $("[data-generate-pokemon-loading]").css("display", "none");
        let pokemon = response.data.pokemon;
        icon = pokemon.sprites.front_default;
        Swal.fire({
            text: response.message,
            confirmButtonText: btnMessage,
            confirmButtonColor: "#136f52",
            iconHtml: '<img src="' + icon + '" style="width: 50px;">',
            allowOutsideClick: false,
        }).then((result) => {
            if (response.data.hasOwnProperty("reloadPage")) {
                window.location.reload(true);
            }
        });
    } else {
        Swal.fire({
            text: response.message,
            confirmButtonText: btnMessage,
            confirmButtonColor: "#136f52",
            icon: icon,
            allowOutsideClick: false,
        }).then((result) => {
            if (response.data.hasOwnProperty("reloadPage")) {
                window.location.reload(true);
            }
        });
    }
}

$.ajaxExecute = function (options) {
    let defaults = {
        url: "",
        data: "",
        type: "",
        dataType: "json",
        cache: false,
        function: null,
    };
    let settings = $.extend({}, defaults, options);
    $.ajax({
        type: settings.type,
        url: settings.url,
        data: settings.data,
        cache: settings.cache,
        dataType: settings.dataType,
        success: function (response) {
            if (settings.funcao != null) {
                fnCall(settings.funcao, response);
            }
        },
    });
};

function fnCall(fn, ...args) {
    let func = typeof fn == "string" ? window[fn] : fn;
    if (typeof func == "function") func(...args);
    else throw new Error(`${fn} is Not a function!`);
}

var myModal = document.getElementById("modal");
var myInput = document.getElementById("myInput");
