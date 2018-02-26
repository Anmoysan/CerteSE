/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 53);
/******/ })
/************************************************************************/
/******/ ({

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(54);


/***/ }),

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

$(function () {
    votes();
    modal();
    coment();
});

function coment() {
    $("#content").on({
        keyup: function keyup() {
            comentar($("#content").val(), $("#event_id").val());
        }
    });
}

function modal() {
    $("#reserva").iziModal({
        width: 750,
        zindex: 999
    });

    $("#abrirReserva").on('click', function () {
        event.preventDefault();
        $("#reserva").iziModal('open');
        $("#mapLugar").hide(1000, function () {});
    });

    $("#unidad").on({
        keyup: function keyup() {
            $("#cost").val(($("#unidad").val() * $("#costEvent").val()).toFixed(2));
        },

        change: function change(e) {
            validateTarget(e.target);
        }
    });

    $("#createReserve").click(function (e) {
        e.preventDefault();
        var enviarFormulario = true;
        var formData = new FormData();
        formData.append('place', $("#place").val());
        formData.append('fecha', $("#fecha").val());
        formData.append('cost', $("#cost").val());
        formData.append('unidad', $("#unidad").val());

        axios.post('/reservar', formData).then(function (response) {
            if (gestionarErrores("#place", response.data.place)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#fecha", response.data.fecha)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#cost", response.data.cost)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#unidad", response.data.unidad)) {
                enviarFormulario = false;
            }

            if (enviarFormulario === true) {
                $("#formReserve").submit();
            }
        });
    });
}

function votes() {
    $("#estrella1").on({
        mouseenter: function mouseenter() {
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function mouseleave() {
            $(this).css("background-color", "#dddddd");
        },

        click: function click() {
            event.preventDefault();
            $("#vote").val(1);
            votar(1, $("#event_id").val());
        }
    });

    $("#estrella2").on({
        mouseenter: function mouseenter() {
            $("#estrella1").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function mouseleave() {
            $("#estrella1").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function click() {
            event.preventDefault();
            $("#vote").val(2);
            votar(2, $("#event_id").val());
        }
    });

    $("#estrella3").on({
        mouseenter: function mouseenter() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function mouseleave() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function click() {
            event.preventDefault();
            $("#vote").val(3);
            votar(3, $("#event_id").val());
        }
    });

    $("#estrella4").on({
        mouseenter: function mouseenter() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function mouseleave() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function click() {
            event.preventDefault();
            $("#vote").val(4);
            votar(4, $("#event_id").val());
        }
    });

    $("#estrella5").on({
        mouseenter: function mouseenter() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $("#estrella4").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function mouseleave() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $("#estrella4").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function click() {
            event.preventDefault();
            $("#vote").val(5);
            votar(5, $("#event_id").val());
        }
    });
}

function votar(valor, evento) {

    $(event.target).addClass("active");
    axios.post('/votar', {
        event_id: evento, vote: valor
    }).then(function (response) {
        $("#contenedor").html(response.data);
        votes();
        modal();
        coment();
    }).catch(function (error) {
        console.log(error);
    });
}

function comentar(content, evento) {

    $(event.target).addClass("active");
    axios.post('/comentar', {
        event_id: evento, content: content
    }).then(function (response) {
        $("#contenedor").html(response.data);
        votes();
        modal();
        coment();
    }).catch(function (error) {
        console.log(error);
    });
}

function gestionarErrores(input, errores) {
    var noEnviarFormulario = false;
    input = $(input);
    if ((typeof errores === "undefined" ? "undefined" : _typeof(errores)) !== ( true ? "undefined" : _typeof(undefined))) {
        input.removeClass("is-invalid");
        input.addClass("is-invalid");
        input.nextAll(".invalid-feedback").remove();
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
            for (var _iterator = errores[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var error = _step.value;

                input.after("<div class=\"invalid-feedback\">\n                <strong> " + error + " </strong>\n            </div>");
            }
        } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
        } finally {
            try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                    _iterator.return();
                }
            } finally {
                if (_didIteratorError) {
                    throw _iteratorError;
                }
            }
        }

        noEnviarFormulario = true;
    } else {
        input.removeClass("is-invalid");
        input.addClass("is-valid");
        input.nextAll(".invalid-feedback").remove();
    }
    return noEnviarFormulario;
}

function validateTarget(target) {
    var formData = new FormData();
    formData.append(target.id, target.value);
    $(target).parent().addClass("spinner");
    axios.post('/reservar', formData).then(function (response) {
        $(target).parent().removeClass("spinner");
        gestionarErrores(target, response.data.place);
        gestionarErrores(target, response.data.fecha);
        gestionarErrores(target, response.data.cost);
        gestionarErrores(target, response.data.unidad);
    }).catch(function (error) {
        console.log(error);
    });
}

/***/ })

/******/ });