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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/calendar.js":
/*!*********************************************!*\
  !*** ./resources/js/components/calendar.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var weeks = ['日', '月', '火', '水', '木', '金', '土'];
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth() + 1;
var startDate = new Date(year, month - 1, 1); // 月の最初の日を取得

var endDate = new Date(year, month, 0); // 月の最後の日を取得

var endDayCount = endDate.getDate(); // 月の末日

var startDay = startDate.getDay(); // 月の最初の日の曜日を取得

var dayCount = 1; // 日にちのカウント

var calendarHtml = ''; // HTMLを組み立てる変数

calendarHtml += '<h1>' + year + '/' + month + '</h1>';
calendarHtml += '<table>'; // 曜日の行を作成

for (var i = 0; i < weeks.length; i++) {
  calendarHtml += '<td>' + weeks[i] + '</td>';
}

for (var w = 0; w < 6; w++) {
  calendarHtml += '<tr>';

  for (var d = 0; d < 7; d++) {
    if (w == 0 && d < startDay) {
      // 1行目で1日の曜日の前
      calendarHtml += '<td></td>';
    } else if (dayCount > endDayCount) {
      // 末尾の日数を超えた
      calendarHtml += '<td></td>';
    } else {
      calendarHtml += '<td>' + dayCount + '</td>';
      dayCount++;
    }
  }

  calendarHtml += '</tr>';
}

calendarHtml += '</table>';
console.log(document.querySelector('#calendar'));
document.querySelector('#calendar').innerHTML = calendarHtml;

/***/ }),

/***/ 1:
/*!***************************************************!*\
  !*** multi ./resources/js/components/calendar.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/user/MyVagrant/MyCentOS/Laravel-Sample/resources/js/components/calendar.js */"./resources/js/components/calendar.js");


/***/ })

/******/ });