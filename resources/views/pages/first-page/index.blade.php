@extends('layouts.main.master')
@section('content')
@include('pages.first-page._partials.header')
@include('pages.first-page._partials.services')
@include('pages.first-page._partials.about-us')
@include('pages.first-page._partials.samples')
@include('pages.first-page._partials.schedule')
@include('pages.first-page._partials.category')
@include('pages.first-page._partials.products')
@include('pages.first-page._partials.discounted')
@include('pages.first-page._partials.tags')
@include('pages.first-page._partials.gallery')
@include('pages.first-page._partials.team')
@include('pages.first-page._partials.certificates')
@include('pages.first-page._partials.packages')
@include('layouts.common.sweetalert')
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/index/index.css?v0.24')}}">
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/index/index.js?v0.2')}}"></script>
<script>
    // Function to convert HEX to RGB
function hexToRgb(hex) {
  // Remove the "#" if present
  const cleanHex = hex.replace('#', '');
  const bigint = parseInt(cleanHex, 16);
  const r = (bigint >> 16) & 255;
  const g = (bigint >> 8) & 255;
  const b = bigint & 255;
  return { r, g, b };
}

// Function to calculate brightness
function getBrightness({ r, g, b }) {
  return (r * 299 + g * 587 + b * 114) / 1000;
}

// Function to update text color based on background brightness
function updateTextColor() {
  // Select all elements with the class 'dynamic-color'
  const elements = document.querySelectorAll('.dynamic-color');

  elements.forEach((element) => {
    // Get the computed background color (assuming it's in HEX format)
    const bgColor = getComputedStyle(element).getPropertyValue('--color-one').trim();
    console.log(bgColor)

    // Ensure the color is in HEX format, otherwise skip
    if (bgColor.startsWith('#')) {
      const rgbColor = hexToRgb(bgColor);
      const brightness = getBrightness(rgbColor);
      console.log(brightness)
      const textColor = brightness > 128 ? '#000' : '#fff';
      
      // Apply the calculated text color to all text elements within the selected element
      element.style.color = textColor;
    }
  });
}

// Call the function to update text colors
updateTextColor();

</script>
<script>
    // Function to convert HEX to RGB
function hexToRgb(hex) {
  // Remove the "#" if present
  const cleanHex = hex.replace('#', '');
  const bigint = parseInt(cleanHex, 16);
  const r = (bigint >> 16) & 255;
  const g = (bigint >> 8) & 255;
  const b = bigint & 255;
  return { r, g, b };
}

// Function to calculate brightness
function getBrightness({ r, g, b }) {
  return (r * 299 + g * 587 + b * 114) / 1000;
}

// Function to update text color based on background brightness
function updateTextColor() {
  // Select all elements with the class 'dynamic-color'
  const elements = document.querySelectorAll('.dynamic-color2');

  elements.forEach((element) => {
    // Get the computed background color (assuming it's in HEX format)
    const bgColor = getComputedStyle(element).getPropertyValue('--color-two').trim();
    console.log(bgColor)

    // Ensure the color is in HEX format, otherwise skip
    if (bgColor.startsWith('#')) {
      const rgbColor = hexToRgb(bgColor);
      const brightness = getBrightness(rgbColor);
      console.log(brightness)
      const textColor = brightness > 128 ? '#000' : '#fff';
      
      // Apply the calculated text color to all text elements within the selected element
      element.style.color = textColor;
    }
  });
}

// Call the function to update text colors
updateTextColor();

</script>
<script>
    // Function to convert HEX to RGB
function hexToRgb(hex) {
  // Remove the "#" if present
  const cleanHex = hex.replace('#', '');
  const bigint = parseInt(cleanHex, 16);
  const r = (bigint >> 16) & 255;
  const g = (bigint >> 8) & 255;
  const b = bigint & 255;
  return { r, g, b };
}

// Function to calculate brightness
function getBrightness({ r, g, b }) {
  return (r * 299 + g * 587 + b * 114) / 1000;
}

// Function to update text color based on background brightness
function updateTextColorHover(event) {
  // Select all elements with the class 'dynamic-color'
  const element = event.target;
    // Get the computed background color (assuming it's in HEX format)
    const bgColor = getComputedStyle(element).getPropertyValue('--color-one').trim();
    console.log(bgColor)

    // Ensure the color is in HEX format, otherwise skip
    if (bgColor.startsWith('#')) {
      const rgbColor = hexToRgb(bgColor);
      console.log(rgbColor)
      const brightness = getBrightness(rgbColor);
      console.log(brightness)
      const textColor = brightness > 128 ? '#000' : '#fff';
      
      // Apply the calculated text color to all text elements within the selected element
      element.style.color = textColor;
    }
}



</script>
@endpush