---

\*\* To build your theme folder in public/test_theme to localhost theme (using laragon or xampp)

-   Step 1: Type

npm install
npm install -g gulp-cli (if you installed, please skip)
npm install gulp-newer --save-dev

-   Step 2: In gulpfile.js , change your theme name

const devDir = './public/test_theme/';
const localwp = 'D:/My_work/wordpresss/test_wp/wp-content/themes/test_theme/';

test_theme -> my_new_theme

-   Step 3: Type
    gulp

---

\*\* Fadein
Example:

<section class="js_inview fadeup">

\*\* font size , plz use @extend
Ex :
@extend %fz-18; => font-size: 18px;

---

covert images to webp

npm install --save-dev gulp-webp
gulp img
