/*! OpenPGP.js v2.1.0 - 2016-02-18 - this is LGPL licensed code, see LICENSE/our website http://openpgpjs.org/ for more information. */!function a(b,c,d){function e(g,h){if(!c[g]){if(!b[g]){var i="function"==typeof require&&require;if(!h&&i)return i(g,!0);if(f)return f(g,!0);var j=new Error("Cannot find module '"+g+"'");throw j.code="MODULE_NOT_FOUND",j}var k=c[g]={exports:{}};b[g][0].call(k.exports,function(a){var c=b[g][1][a];return e(c?c:a)},k,k.exports,a,b,c,d)}return c[g].exports}for(var f="function"==typeof require&&require,g=0;g<d.length;g++)e(d[g]);return e}({1:[function(a,b,c){function d(a){e.crypto.random.randomBuffer.size<f&&self.postMessage({event:"request-seed"}),self.postMessage(a,e.util.getTransferables.call(e.util,a.data))}self.window={},importScripts("openpgp.min.js");var e=window.openpgp,f=4e4,g=6e4;e.crypto.random.randomBuffer.init(g),self.onmessage=function(a){var b=a.data||{},c=b.options||{};switch(b.event){case"configure":for(var f in b.config)e.config[f]=b.config[f];break;case"seed-random":b.buf instanceof Uint8Array||(b.buf=new Uint8Array(b.buf)),e.crypto.random.randomBuffer.set(b.buf);break;default:if("function"!=typeof e[b.event])throw new Error("Unknown Worker Event");e[b.event](e.packet.clone.parseClonedPackets(c,b.event)).then(function(a){d({event:"method-return",data:e.packet.clone.clonePackets(a)})})["catch"](function(a){d({event:"method-return",err:a.message})})}}},{}]},{},[1]);