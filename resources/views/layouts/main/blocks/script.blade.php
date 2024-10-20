<script src="{{asset('assets/site/js/shared/jquery.min.js')}}"></script>
<script src="{{asset('assets/site/js/shared/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/site/js/shared/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/site/js/shared/style.js?v0.06')}}"></script>
<script src="{{asset('assets/site/js/product/list.js')}}"></script>
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

    // Ensure the color is in HEX format, otherwise skip
    if (bgColor.startsWith('#')) {
      const rgbColor = hexToRgb(bgColor);
      const brightness = getBrightness(rgbColor);
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
@stack('scripts')
@stack('vue')