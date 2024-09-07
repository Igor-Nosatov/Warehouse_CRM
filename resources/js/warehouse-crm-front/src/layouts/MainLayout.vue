<template>
  <div class="main-layout">
    <Navbar />
    <router-view class="main-content"></router-view>
  </div>
</template>

<script setup>
import Navbar from "@/components/layout/Navbar.vue";
</script>

<style>
.main-layout {
  background-color: #192227;
  min-width:1600px;
}

.main-content {
  min-width: 1600px;
  font-family: "Montserrat", sans-serif !important;
  font-weight: 400 !important;
  font-style: normal !important;
}

.sub-navbar {
  height: 90px !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.tab-navigation {
  background: #0d171a;
  border-radius: 10px;
  padding: 5px;
  height: auto;
  width: fit-content;
}

.sidebar {
  border-radius: 15px;
  background-color: #192227;
  height: auto;
  position: relative;
  width: 420px;
  margin-bottom: 20px;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em,
    rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em,
    rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
  margin-top: 11px !important;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="file"] {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    border: 2px solid #ccc;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="file"]::-webkit-file-upload-button {
    cursor: pointer;
    background-color: #333;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    font: 18px "Nunito", sans-serif;
    margin-top:7px;
}

/*======================= Keyframe Animations ================================*/
@keyframes fadeInAndSlideIn {
  from {
    opacity: 0;
    transform: translateX(100%);
  }

  to {
    opacity: 1;
    transform: translateX(33%);
  }
}
@keyframes fadeIn {
  to {
    opacity: 1;
  }
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
  }

  to {
    transform: translateX(0);
  }
}
/*======================= End Keyframe Animations ================================*/

/*=====================Text-style===================*/
.title-page {
  color: #e0e9ec;
  font: 16px "Nunito", sans-serif;
  padding: 20px 20px 20px 30px;
}

.filter-title {
  margin: 10px 0px 0px 0px;
  font: 16px "Nunito", sans-serif !important;
  color: #919da1;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  text-transform: uppercase;
  font-weight: 700 !important;
}

.status-score {
  padding-top: 11px;
  color: #fff;
  font: 16px "Nunito", sans-serif;
}
.color-white {
  color: #fff;
}

.order-title {
  font: 18px "Nunito", sans-serif !important;
  font-weight: bold !important;
  color: #fff;
  margin-top: 10px;
  padding: 5px 15px 5px 35px;
  border-right: 1px solid #283f49;
}

.violet-color {
  color: #c670f1 !important;
}
.primary-text {
  color: #fff;
  font: 18px/1 "Nunito", sans-serif;
  font-weight: 700;
}
.icon-size {
  font-size: 25px;
  color: #fff;
}
.secondary-text {
  font: 16px/1 "Nunito", sans-serif;
  color: #fff;
}
.secondary-text-1 {
  font: 16px/1 "Nunito", sans-serif;
  color: #c0c9cc;
}
.green-color {
  color: #00d26d;
}

.title-text {
  color: #fff;
  font: 22px "Nunito", sans-serif;
  font-weight: 500;
}
.primary-text {
  color: #fff !important;
  font: 16px "Nunito", sans-serif;
}
.secondary-text {
  font: 16px "Nunito", sans-serif;
  font-weight: 400;
  color: #677172;
}
.dot-for-modal-content1,
.dot-for-modal-content3 {
  top: 5px;
}
.dot-for-modal-content2 {
  top: 7px;
}

.dot-for-modal-content1,
.dot-for-modal-content2,
.dot-for-modal-content3 {
  height: 10px;
  width: 10px;
  border-radius: 100%;
  background: #677172;
  position: relative;
}

.dot-for-modal-content3 {
  background: #c670f1;
}

/*===================Button========================*/
.tab-navigation-btn {
  color: #5c6869;
  font: 16px "Nunito", sans-serif;
  padding: 12px;
  transition: all 0.6s ease-out;
  border-radius: 10px;
  margin: 0px 3px;
}

.tab_navigation_btn_active {
  color: #00f579;
  background: #1c2e37;
  border-radius: 10px;
  padding: 12px;
  margin: 0px 3px;
}

.sub-navbar-btn {
  margin-top: 8px !important;
  border: 1px #70888f solid;
  margin: 5px 6px;
  font: 16px "Nunito", sans-serif;
  background-color: #111e22;
  color: #a2b2bb;
  text-transform: capitalize;
  font-weight: 700;
  height: 45px !important;
  border-radius: 15px;
  transition: all 0.5s ease-out;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.sub-navbar-btn:hover {
  color: #000 !important;
  background-color: #39db7d;
  border: 1px #39db7d solid;
}

.button-label.active {
  border: 1px solid #39db7d !important;
  background-color: #111e22;
  color: #39db7d;
}

.hidden {
  display: none;
}

.radio-label:checked + .button-label {
  border: 1px solid #39db7d;
}

.select-btn {
  border: 1px solid #dcdcdc;
}

.select-btn:focus {
  border-color: #39db7d;
}

.min-price-input,
.max-price-input {
  border: 1px solid #dcdcdc;
}

.min-price-input:focus,
.max-price-input:focus {
  border-color: #39db7d;
}

.status-score {
  margin-top: 3px;
  font-size: 14px !important;
  color: #fff;
  height: 32px;
  width: auto;
  padding-bottom: 10px !important;
}

.reset-btn-bottom,
.reset-btn-top {
  background: #1e292f;
  border: 1px #223842 solid;
  color: #fff;
  font: 16px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: all 0.5s ease-out;
}

.reset-btn-bottom:hover,
.reset-btn-top:hover {
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}

.reset-btn-top {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
}

.reset-btn-bottom {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.button-label {
  background: #1e292f;
  border: 1px #223842 solid !important;
  border-left: transparent !important;
  color: #fff;
  font: 16px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: all 0.5s ease-out;
  width: 190px !important;
  outline: none;
  padding: 5px 15px 0px 15px;
  border-radius: 10px !important;
  margin-top: 10px;
}

.status-score-data {
  font: 18px "Nunito", sans-serif;
  position: relative;
  bottom: 5px;
}

.hidden {
  display: none;
}

#all-btn:checked + .button-label,
#active-btn:checked + .button-label,
#inactive-btn:checked + .button-label,
#draft-btn:checked + .button-label,
#retail-btn:checked + .button-label,
#wholesale-btn:checked + .button-label {
  background-color: #2a3b41;
  border: 1px #39db7d solid;
}

.select-wrapper {
  width: 400px !important;
}

.select-btn {
  background: #1e292f;
  border: 1px #223842 solid !important;
  color: #fff;
  font: 16px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: all 0.5s ease-out;
  width: 100% !important;
  font-weight: 600;
  outline: none;
  border-radius: 10px;
  padding-left: 50px !important;
  border: 1px #70888f solid !important;
}

.select-btn option {
  outline: none !important;
  background: #1e292f;
  border: 1px #223842 solid !important;
  color: #fff;
  font-family: "Nunito", sans-serif;
  font-weight: 600;
  text-transform: capitalize;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  border: 1px solid #223842;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
  border: 1px #70888f solid !important;
}

.apply-btn-top,
.reset-btn-top,
.apply-btn-bottom,
.reset-btn-bottom {
  background: #1e292f;
  border: 1px #223842 solid;
  color: #fff;
  font: 16px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: all 0.5s ease-out;
  width: 209.25px;
  border-radius: 0px;
  transition: all 0.4s ease-out!important;
}

.apply-btn-top:hover,
.reset-btn-top:hover {
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}

.reset-btn-top {
  position: relative;
  top: 0;
  left: 307px !important;
  border-top-right-radius: 15px;
}

.apply-btn-top {
  position: relative;
  top: 0;
  right: 217px !important;
  border-top-left-radius: 15px;
}

.reset-btn-bottom {
  position: relative;
  left: 306.4px !important;
  border-bottom-right-radius: 15px;
}

.apply-btn-bottom {
  position: relative;
  right: 217.98px !important;
  border-bottom-left-radius: 15px;
}

.btn-position {
  top: 11px;
}

.close-btn {
  border-radius: 10px;
  background: #1c2e37;
  cursor: pointer;
  font-size: 20px;
  height: 45px !important;
  width: 45px !important;
  color: #fff;
  outline: none;
  border: none;
}

.cube-btn {
  border: 1px solid #70888f;
  background-color: #111e22 !important;
  color: #a2b2bb;
  font-size: 24px !important;
  line-height: 21px;
  height: 45px !important;
  width: 45px !important;
  text-align: center;
  border-radius: 15px;
  margin: 8px 5px 0px 5px;
  transition: all 0.6s ease-out;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.cube-btn:hover {
  color: #fff !important;
  background-color: #253d44 !important;
  border: 1px #253d44 solid;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.wr-primary-btn {
  padding: 5px 35px !important;
  border: 1px #253d44 solid;
  font: 18px "Nunito", sans-serif;
  background-color: #111e22 !important;
  color: #fff !important;
  text-transform: capitalize;
  font-weight: 500;
  height: 55px !important;
  border-radius: 15px !important;
  transition: all 0.5s ease-out !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  width:fit-content !important;
}

.dropdown_list {
  border-radius: 15px !important;
  background-color: #111e22 !important;
  border: 1px solid #70888f !important;
  color: #fff !important;
  height: 100px;
}

/*======================Sort Button===================================*/
.sort-option {
  padding: 10px;
  cursor: pointer;
  overflow-y: auto;
}

.sort-option:hover {
  background-color: #1e292f;
}

.sort-option.active {
  background-color: #1e292f;
}

.sort-option:active {
  background-color: #1e292f;
}

.sort-label {
  font-size: 16px;
  font-weight: bold;
}

.radio-label {
  width: 100px !important;
}

.sort-select {
  position: relative;
}

.selected-option {
  cursor: pointer;
  padding: 10px;
  width: 102%;
  background: #19222a;
  border: 1px #223842 solid !important;
  color: #fff;
  border-radius: 10px;
  font: 16px "Nunito", sans-serif;
  display: flex;
  align-items: center;
  justify-content: space-between;
  min-height: 55px;
  width: 100%!important;
}

.sort-options {
  position: absolute;
  top: 103%;
  left: 0;
  width: 102%;
  background: #19222a;
  border: 1px #223842 solid !important;
  font: 16px "Nunito", sans-serif;
  color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  z-index: 10;
  border-radius: 10px;
  overflow-y: auto;
  min-height: 90px;
  max-height: 200px;
  width: 100%!important;
}


.sort-option {
  padding: 10px;
  cursor: pointer;
  text-transform: capitalize !important;
}

.sort-option:hover {
  background: #252525;
  border-radius: 10px;
}

.sort-option.active {
  background: #252525;
  color: #fff;
}

/*======================End Sort Button===================================*/

/*======================Score Pill===================================*/
.score-pill {
  color: #e0e9ec;
  background-color: #000;
  border: 1px solid #243a44;
  padding: 0px 5px;
  height: 26px;
  width: fit-content;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.score-pill-number {
  color: #fff;
  font: 14px "Nunito", sans-serif;
  font-weight: bold;
  padding-left: 5px;
}

.score-pill-text {
  color: #60686b;
  font: 14px "Nunito", sans-serif;
  font-weight: 700;
  padding: 0px 8px;
}

/*======================End Score Pill===================================*/

/*===================Icons=========================*/
.icon-size {
  font-size: 25px;
}

.la-dollar-sign {
  background: #1e292f;
  border: 1px #223842 solid;
  border-right: transparent;
  color: #fff;
  font-size: 18px;
  text-transform: capitalize;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  padding: 15px;
}

.la-dollar-sign-position{
position: relative;
bottom: 54.5px;
left:0.2px;
height: 53px;
border-top-left-radius: 15px;
border-bottom-left-radius: 15px;
}





.select-wrapper .la-sort,
.select-wrapper .la-clipboard-check,
.select-wrapper .la-cubes,
.select-wrapper .la-globe {
  position: absolute;
  top: calc(50% - 15px);
  left: 10px;
  font-size: 20px;
  color: #242d32;
  background: #5b6268 !important;
  border: 1px #5b6268 solid !important;
  border-radius: 5px;
  padding: 3px;
}

.select-wrapper .arrow {
  position: absolute;
  top: calc(50% - 15px);
  right: 10px;
  font-size: 20px;
  color: #666;
}

.select-wrapper,
.select-wrapper .la-clipboard-check,
.select-wrapper .la-cubes,
.select-wrapper .la-globe,
.select-wrapper .la-user-tie,
.select-wrapper .la-user-ninja,
.select-wrapper .la-street-view {
  position: absolute;
  top: calc(50% - 15px);
  left: 10px;
  font-size: 20px;
  color: #242d32;
  background: #5b6268 !important;
  border: 1px #5b6268 solid !important;
  border-radius: 5px;
  padding: 3px;
}

.la-cubes,
.la-globe {
  position: relative;
  font-size: 20px;
  color: #242d32;
  background: #5b6268 !important;
  border: 1px #70888f solid !important;
  border-radius: 5px;
  padding: 3px;
}

.la-cubes,
.la-globe {
  top: -40px;
}

/*===============Modal dialog============================================================*/
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.modal-form {
  border-radius: 15px !important;
  color: #fff;
  font: 16px "Nunito", sans-serif !important;
  border: 1px solid #919da1;
  background-color: #192227;
  box-shadow: rgba(39, 39, 39, 0.35) 0px 5px 15px;
}
.create-form{
  width:1000px;
  min-height: 650px;
  max-height: 900px;
}
.edit-form{
  width:1000px;
  min-height: 650px;
  max-height: 900px;
}
/*===============END modal dialog============================================================*/

/*===================Inputs========================*/
input {
  outline: none !important;
}

.wr-input-title,
.wr-form-label{
  color: #fff;
  font-size: 18px;
  font-family: "Nunito", sans-serif !important;
  font-weight: 500 !important;
}

.wr-form-input,
.wr-qty-input,
.wr-form-textarea {
  font-size: 16px;
  font-family: "Nunito", sans-serif !important;
  color: #fff;
  margin-top: 8px;
  border-radius: 15px;
  font-weight: 500;
  border: 1px solid #2f3943;
  background: #19222a;
  min-height: 55px;
  width: 450px;
  outline: none;
  cursor: pointer;
  padding: 0px 15px;
}
.wr-form-textarea{
  width:100%;
}
.wr-form-textarea {
  padding: 15px;
  color: #fff !important;
  font-family: "Nunito", sans-serif !important;
  font-weight: 500 !important;
}
.wr-form-input-small{
  width: 305px;
}
.wr-form-input-contact-help{
  width: 100%;
}
.wr-form-title {
  color: #fff;
  font-size: 30px;
  font-family: "Nunito", sans-serif !important;
}

.wr-form-subtitle {
  color: #a2b2bb;
  font-size: 20px;
  font-family: "Nunito", sans-serif !important;
}

.min-price-input,
.max-price-input,
.min-range-input,
.max-range-input {
  background: #1e292f;
  border: 1px #223842 solid !important;
  border-left: transparent !important;
  color: #fff;
  font: 16px "Nunito", sans-serif;
  text-transform: capitalize;
  height: 50px !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: all 0.5s ease-out;
  width: 450px;
  outline: none;
  padding: 0px 10px;
  position: relative;
  left: 1px;
  border-radius: 10px !important;
}

.min-price-input:active,
.max-price-input:active,
.min-range-input:active,
.max-range-input:active {
  outline: none;
}

.min-price-input,
.max-price-input {
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
}

input {
  outline: none !important;
}

.input-title,
.add-form-label,
.common-input-style {
  color: #fff!important;
  font-size: 18px;
  font-family: "Nunito", sans-serif !important;
  font-weight: 500 !important;
}
.common-input-style,
.qty-input {
  margin-top: 8px;
  border-radius: 15px!important;
  font-weight: 500;
  border: 1px solid #2f3943!important;
  background: #19222a;
  min-height: 55px;
  width: 100%;
  outline: none;
  cursor: pointer;
  padding: 0px 15px;
}
.add-form-title {
  color: #fff;
  font-size: 30px;
  font-family: "Nunito", sans-serif !important;
}
.add-form-subtitle {
  color: #a2b2bb;
  font-size: 20px;
  font-family: "Nunito", sans-serif !important;
}
/*=====================Checkbox style=========================*/
.wr-checkbox-container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: #fff !important;
  font-family: "Nunito", sans-serif !important;
  cursor: pointer;
}

.wr-checkbox-container input {
  position: absolute;
  opacity: 0;
  height: 0;
  width: 0;
  color: #fff !important;
  font-family: "Nunito", sans-serif !important;
  font-size: 18px !important;
}

.wr-form-checkbox {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 5px;
  border: 1px solid #2f3943;
  background: #19222a;
}

.wr-checkbox-container:hover input ~ .wr-form-checkbox {
  background: #19222a;
}

.wr-checkbox-container input:checked ~ .wr-form-checkbox {
  background-color: #39db7d;
}

.wr-form-checkbox:after {
  content: "\2713";
  position: absolute;
  bottom: -1.5px;
  left: 4.5px;
  display: none;
}

.wr-checkbox-container input:checked ~ .wr-form-checkbox:after {
  display: block;
}
/*=====================Checkbox style=========================*/
.checkbox-container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: #fff !important;
  font-family: "Nunito", sans-serif !important;
  cursor: pointer;
}

.checkbox-container input {
  position: absolute;
  opacity: 0;
  height: 0;
  width: 0;
  color: #fff !important;
  font-family: "Nunito", sans-serif !important;
  font-size: 18px !important;
}

.add-form-checkbox {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 5px;
  border: 1px solid #2f3943;
  background: #19222a;
}

.checkbox-container:hover input ~ .add-form-checkbox {
  background: #19222a;
}

.checkbox-container input:checked ~ .add-form-checkbox {
  background-color: #39db7d;
}

.add-form-checkbox:after {
  content: "\2713";
  position: absolute;
  bottom: -1.5px;
  left: 4.5px;
  display: none;
}

.checkbox-container input:checked ~ .add-form-checkbox:after {
  display: block;
}

.price-label {
  color: #fff;
  font-family: "Nunito", sans-serif !important;
  font-size: 18px !important;
  margin-left: 3px;
}
.price-input {
  padding: 0px 0px 0px 55px;
}
.price-input-1 {
  padding: 0px 0px 0px 75px;
}
/*=========Search input===========================================================*/
.search-wrapper {
  height: 45px !important;
}

.search-bar-btn {
  height: 45px !important;
  border-top: 1px solid #70888f !important;
  border-left: 1px solid #70888f !important;
  border-bottom: 1px solid #70888f !important;
  border-right: 1px solid transparent !important;
  cursor: pointer;
  background-color: #111e22 !important;
  position: relative;
  bottom: 1px;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
  border-top-left-radius: 15px !important;
  border-bottom-left-radius: 15px !important;
  font-size: 25px !important;
  font-weight: bold;
  color: #fff !important;
  transition: all 0.7s ease-out;
  position: relative;
  bottom: 4.5px;
}

.search-bar-btn:hover {
  color: #fff !important;
  background-color: #253d44 !important;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7) !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5) !important;
}

.search-input {
  height: 45px !important;
  border-top: 1px solid #70888f;
  border-right: 1px solid #70888f;
  border-bottom: 1px solid #70888f;
  border-top-right-radius: 15px !important;
  border-bottom-right-radius: 15px !important;
  padding: 0px 10px !important;
  min-width: 630px;
  color: #fff;
  font: 18px "Nunito", sans-serif;
  position: relative;
  bottom: 4px;
}

.search-input:focus {
  outline: none;
}

.search-input-sidebar {
  height: 45px !important;
  border-top: 1px solid #70888f;
  border-right: 1px solid #70888f;
  border-bottom: 1px solid #70888f;
  border-top-right-radius: 15px !important;
  border-bottom-right-radius: 15px !important;
  padding: 0px 10px !important;
  min-width: 300px !important;
  color: #fff;
  font: 18px "Nunito", sans-serif;
  position: relative;
  bottom: 4px;
}

/*===============ItemCard============================================================*/
.item-card {
  border-radius: 15px;
  background-color: #192227;
  height: auto;
  width: 100%;
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px,
    rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
  margin-top: 3px;
}

.item-card {
  border-radius: 15px;
  background-color: #192227;
  height: 110px;
}

.card-img {
  margin-left: 10px;
  height: 90px;
  width: 120px;
  border-radius: 15px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.card-img-photo {
  margin-top: 15px;
  margin-left: 10px;
  height: 70px;
  width: 70px;
  border-radius: 100%;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.completed-action {
  background: #00d26d;
}

.card-title {
  color: #fff;
  font: 16px "Nunito", sans-serif;
  font-weight: 500;
  padding: 10px;
}

.card-title-secondary {
  color: #5b6268;
  font: 14px "Nunito", sans-serif;
  font-weight: 500;
  padding: 10px;
}

.card-text-desc {
  color: #fff;
  font: 14px "Nunito", sans-serif;
  font-weight: 500;
  padding: 10px;
}

.card-img {
  width: 40%;
  border-radius: 10px;
}
.dot {
  margin: 10px 10px 0px 8px;
  height: 10px;
  width: 10px;
  border-radius: 100%;
  background: #000;
}

.card-product-title {
  font: 22px "Nunito", sans-serif !important;
  color: #fff;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  font-weight: 800 !important;
}

.card-product-type {
  border-left: 1px solid #919da1;
}

.card-product-category,
.card-product-type {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  font-weight: 600 !important;
  margin-top: 2px;
}

.card-product-stock-level {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  font-weight: 600 !important;
  margin-top: 3px;
}

.card-product-count-stock {
  font: 18px "Nunito", sans-serif !important;
  color: #fff;
  font-weight: 600 !important;
  margin-top: 2px;
  margin-left: 2px;
}

.border-left-card-price {
  border-left: 1px solid #919da1;
  height: auto;
  padding-left: 30px;
}

.card-price-title {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  text-transform: capitalize;
  font-weight: 600 !important;
}

.card-price {
  font: 18px "Nunito", sans-serif !important;
  color: #fff;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  font-weight: 600 !important;
}

.cube-btn-small {
  height: 40px;
  width: 40px;
  position: relative;
  right: 3px;
  top: 5px;
}
.item-card-dot {
  height: 8px;
  width: 8px;
  border-radius: 100%;
  background: #c0c9cc;
  position: relative;
  top: 12px;
  left: 5px;
}
.item-card-vendor,
.item-card-purchase-order {
  margin: 10px 0px;
  border-radius: 15px;
  background-color: #192227;
  box-shadow: rgba(39, 39, 39, 0.35) 0px 5px 15px;
  border: 2px solid #1e292f;
  color: #fff;
}

.item-card-vendor {
  height: 210px !important;
}

.item-card-purchase-order,
.item-card-sales-order {
  height: 180px !important;
}

.order-line-divider {
  height: 30px;
  width: 3px;
  background: #fff;
}
.line_divider1 {
  background: #e0e0e0;
  height: 55px;
  margin-left: 10px;
  margin-right: 10px;
  width: 1px;
  position: relative;
  top: 28px;
  left: 30px;
}
.line_divider2 {
  background: #e0e0e0;
  height: 25px;
  margin-left: 10px;
  margin-right: 10px;
  width: 1px;
}
.vendor-status {
  border-radius: 15px;
  background-color: #303d44;
  height: 60px;
}

.card-img {
  margin-left: 10px;
  height: 90px;
  width: 120px;
  border-radius: 15px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.card-img-photo {
  margin-top: 15px;
  margin-left: 10px;
  height: 70px;
  width: 70px;
  border-radius: 100%;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.dot {
  margin: 10px 10px 0px 8px;
  height: 10px;
  width: 10px;
  border-radius: 100%;
  background: #000;
}

.card-product-title {
  font: 18px "Nunito", sans-serif !important;
  color: #fff;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  font-weight: 600 !important;
}

.card-product-subtitle {
  font: 18px "Nunito", sans-serif !important;
  color: #e0e0e0;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  font-weight: 400 !important;
  position: relative;
  bottom: 10px;
}

.contact-block {
  border-left: 1px solid #e0e0e0;
  margin-left: 15px;
}

.contact-icon {
  position: relative;
  top: 4px;
}

.company_title_desc {
  border-right: 1px solid #e0e0e0;
  width: 1px;
  height: 45px;
}

.card-product-type {
  border-left: 1px solid #919da1;
}

.card-product-category,
.card-product-type {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  font-weight: 600 !important;
}

.card-product-stock-level {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  font-weight: 600 !important;
  margin-top: 3px;
}

.card-product-count-stock {
  font: 18px "Nunito", sans-serif !important;
  color: #fff;
  font-weight: 600 !important;
  margin-top: 3.5px;
  margin-left: 2px;
}

.card-product-category {
  margin-top: 2.5px;
}

.border-left-card-price {
  border-left: 1px solid #919da1;
  height: auto;
  padding-left: 30px;
}

.card-price-title {
  font: 18px "Nunito", sans-serif !important;
  color: #919da1;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  text-transform: capitalize;
  font-weight: 600 !important;
}

.card-price,
.card-sub-title {
  font: 18px "Nunito", sans-serif !important;
  color: #fff;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  font-weight: 600 !important;
}

.card-sub-title {
  margin-top: 3px;
}

.package-status {
  background-color: #c91d64;
  color: #fff;
  border-radius: 10px;
  height: 30px !important;
  width: fit-content !important;
  padding: 0px 5px;
}

.package-status-position {
  position: relative;
  bottom: 5px;
}

.history-data-block {
  height: 520px;
  overflow-y: auto;
  border: 1px solid #919da1;
  border-radius: 15px;
}

/*===============END  ItemCard============================================================*/

/*============== Pagination ============================================================*/
.btn-pagination-dots {
  margin-top: 11px;
  cursor: pointer;
  transition: all 0.6s ease-out;
}

.btn-pagination-dots:hover {
  background-color: #111e22;
}

.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
  width: 1200px;
}

ul {
  list-style-type: none !important;
  margin: 0 !important;
  padding: 0 !important;
}

ul a {
  text-decoration: none !important;
}

.page-link {
  font: 18px "Nunito", sans-serif !important;
  color: #fff !important;
  font-weight: 600 !important;
  border-radius: 15px;
  border: 1px solid #2f3943;
  padding: 10px 20px;
  margin: 0px 5px;
  cursor: pointer;
  transition: all 0.6s ease-out;
}

.page-link:hover {
  background-color: #111e22;
}
/*===============END  Pagination============================================================*/
</style>
