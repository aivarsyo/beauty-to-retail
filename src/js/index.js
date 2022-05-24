import "../scss/style.scss";
import $ from "jquery";
import { gsap } from "gsap";
import { Power0 } from "gsap";
import imagesLoaded from "imagesloaded";
import Isotope from "isotope-layout";
import Flickity from "flickity";

window.addEventListener("DOMContentLoaded", start);

function start() {
  menu();
  slider();
  ticker();
  brandLayout();
  pressSlider();
  calcWidth();
  viewportHeight();
}

function viewportHeight(){
// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

// We listen to the resize event
window.addEventListener('resize', () => {
  console.log("resize")
  // We execute the same script as before
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
});
}

function menu() {
  let menuWidth = document.querySelector(".menu-wrapper").offsetWidth;
  const burger = document.querySelector(".burger");
  const menuWrapper = document.querySelector(".menu-wrapper");
  const cover = document.querySelector(".transparent-cover");

  window.addEventListener("resize", function () {
    menuWidth = menuWrapper.offsetWidth;
  });

  burger.addEventListener("click", menuAction);
  cover.addEventListener("click", menuAction);

  function menuAction() {
    if (burger.classList.contains("opened")) {
      gsap.to(menuWrapper, 0.3, {
        x: "100%",
        ease: Power0.easeOut,
      });
      gsap.to(".topLine", 0.3, {
        attr: { y2: 0.4, x2: 22.4 },
      });
      gsap.to(".bottomLine", 0.3, {
        attr: { y2: 12.4, x2: 22.4 },
      });
      gsap.to(".middleLine", 0.3, {
        opacity: 1,
      });
      gsap.to("main, footer", 0.3, {
        x: 0,
        ease: Power0.easeOut,
      });
      gsap.to(cover, 0.3, {
        opacity: 0,
        zIndex: -1,
      });
      gsap.set("body", {
        overflowY: "initial",
      });
      burger.classList.remove("opened");
    } else {
      gsap.to(menuWrapper, 0.3, {
        x: 0,
        ease: Power0.easeIn,
      });
      gsap.to(".topLine", 0.3, {
        attr: { y2: 12.4, x2: 13.4 },
      });
      gsap.to(".bottomLine", 0.3, {
        attr: { y2: 0.4, x2: 13.4 },
      });
      gsap.to(".middleLine", 0.3, {
        opacity: 0,
      });
      gsap.to("main, footer", 0.3, {
        x: -menuWidth,
        ease: Power0.easeIn,
      });
      gsap.set(cover, {
        zIndex: 1,
      });
      gsap.to(cover, 0.3, {
        opacity: 1,
      });
      gsap.set("body", {
        overflowY: "hidden",
      });
      burger.classList.add("opened");
    }
  }

  // on resize

  window.addEventListener("resize", function () {
    if (this.innerWidth > 1100) {
      gsap.set(menuWrapper, {
        x: 0,
      });
      gsap.set(".topLine", {
        attr: { y2: 0.4, x2: 22.4 },
      });
      gsap.set(".bottomLine", {
        attr: { y2: 12.4, x2: 22.4 },
      });
      gsap.set(".middleLine", {
        opacity: 1,
      });
      gsap.to("main, footer", 0.3, {
        x: 0,
        ease: Power0.easeOut,
      });
      gsap.to(cover, 0.3, {
        opacity: 0,
        zIndex: -1,
      });

      burger.classList.remove("opened");
    } else {
      if (!burger.classList.contains("opened")) {
        gsap.set(menuWrapper, {
          x: "100%",
        });
      }
    }
  });
}

// global variables
let flktySlider;
let flktyTicker;
//

function slider() {
  const slider = document.querySelector(".slider");
  if (slider) {
    let options = {
      freeScroll: true,
      wrapAround: true,
      pageDots: false,
      autoPlay: 5000,
      groupCells: true,
      pauseAutoPlayOnHover: false,
    };

    const mediaQueryTablet = window.matchMedia("(max-width: 834px)");
    if (mediaQueryTablet.matches) {
      options.prevNextButtons = false;
    }

    const mediaQueryMobile = window.matchMedia("(max-width: 425px)");
    if (mediaQueryMobile.matches) {
      options.autoPlay = false;
      options.freeScroll = false;
    }

    flktySlider = new Flickity(".slider", options);
  }
}

function ticker() {
  const ticker = document.querySelector(".ticker");
  if (ticker) {
    let options = {
      freeScroll: true,
      wrapAround: true,
      pageDots: false,
      prevNextButtons: false,
      autoPlay: 5000,
      groupCells: true,
      pauseAutoPlayOnHover: false,
    };

    const mediaQueryMobile = window.matchMedia("(max-width: 600px)");
    if (mediaQueryMobile.matches) {
      options.autoPlay = false;
    }

    flktyTicker = new Flickity(".ticker", options);
  }
}

// global variables for isotope
const threeCol = [
  3,
  4,
  8,
  12,
  13,
  17,
  21,
  22,
  27,
  29,
  31,
  36,
  37,
  41,
  43,
  47,
  49,
  53,
  57,
  58,
  62,
  66,
  68,
  70,
  74,
  78,
  80,
  83,
  85,
  89,
  93,
  95,
  99,
];
const isotopeGrid = document.querySelector(".isotope-grid");
let buttonFilter = "*";
let filterCount;
let filteredItems;
const quicksearch = document.querySelectorAll(".quicksearch");
// quick search regex
var qsRegex;
//

function calcWidth() {
  if (isotopeGrid) {
    // variables
    const isotopeItem = document.querySelectorAll(".one-isotope-item");
    const mediaQueryBig = window.matchMedia("(min-width:1024px)");
    const mediaQueryNormal = window.matchMedia(
      "(min-width: 835px) and (max-width: 1023px)"
    );

    // big screen
    if (mediaQueryBig.matches) {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 120px) / 3 - 3%)";
      });
      threeCol.forEach((el) => {
        const item = document.querySelector(
          ".one-isotope-item:nth-of-type(" + el + ")"
        );
        if (item) {
          item.style.width = "calc((99.9% - 120px) / 3 + 6%)";
        }
      });
      // normal screen
    } else if (mediaQueryNormal.matches) {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 60px) / 3 - 3%)";
      });
      threeCol.forEach((el) => {
        const item = document.querySelector(
          ".one-isotope-item:nth-of-type(" + el + ")"
        );
        if (item) {
          item.style.width = "calc((99.9% - 60px) / 3 + 6%)";
        }
      });
    }
  }
}

// changes isotope item size in categories on button click and resize

function changeSize() {
  // variables
  const isotopeItem = document.querySelectorAll(".one-isotope-item");
  const mediaQueryBig = window.matchMedia("(min-width:1024px)");
  const mediaQueryNormal = window.matchMedia(
    "(min-width: 835px) and (max-width: 1023px)"
  );
  //
  if (mediaQueryBig.matches) {
    if (filterCount < 3) {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 90px) / 2)";
      });
    } else {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 120px) / 3 - 3%)";
      });
      threeCol.forEach((number) => {
        if (filteredItems[number - 1]) {
          filteredItems[number - 1].element.style.width =
            "calc((99.9% - 120px) / 3 + 6%)";
        }
      });
    }
  } else if (mediaQueryNormal.matches) {
    if (filterCount < 3) {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 45px) / 2)";
      });
    } else {
      isotopeItem.forEach((item) => {
        item.style.width = "calc((99.9% - 60px) / 3 - 3%)";
      });
      threeCol.forEach((number) => {
        if (filteredItems[number - 1]) {
          filteredItems[number - 1].element.style.width =
            "calc((99.9% - 60px) / 3 + 6%)";
        }
      });
    }
  }
}

/////////////////////////////

function brandLayout() {
  if (isotopeGrid) {
    let iso;

    // clear search field on page refresh
    quicksearch.forEach((search) => {
      search.value = "";
    });

    // when images loaded - initialise isotope
    imagesLoaded(".isotope-grid", function () {
      iso = new Isotope(".isotope-grid", {
        itemSelector: ".one-isotope-item",
        layoutMode: "fitRows",
        percentPosition: true,
        fitRows: {
          gutter: ".gutter-sizer",
        },
        filter: filterResult,
      });
    });

    function filterResult(itemElem) {
      var searchResult = qsRegex ? itemElem.textContent.match(qsRegex) : true;
      var buttonResult = buttonFilter ? itemElem.matches(buttonFilter) : true;
      return searchResult && buttonResult;
    }

    // category buttons
    $("#filters").on("click", "button", function () {
      buttonFilter = $(this).attr("data-filter");
      // clears search field when category button clicked
      quicksearch.forEach((search) => {
        search.value = "";
      });
      qsRegex = "";
      iso.arrange();
      // checks how many items are filtered and changes size for items
      filterCount = iso.filteredItems.length;
      filteredItems = iso.filteredItems;
      changeSize();
      iso.layout();

      // hidden categories close them
      const mediaQueryCat = window.matchMedia("(max-width:1024px)");
      if (mediaQueryCat.matches) {
        closeCat();
      }
    });

    // use value of search field to filter

    quicksearch.forEach((search) => {
      search.addEventListener(
        "keyup",
        debounce(function () {
          // when something is typed, changes to category "all" automatically
          buttonFilter = "*";

          // highlights the 'show all' button
          var $buttonGroup = $(".button-group");
          $buttonGroup.find(".is-checked").removeClass("is-checked");
          $(".button-group button:nth-of-type(1)").addClass("is-checked");

          qsRegex = new RegExp(search.value, "gi");
          iso.arrange();
          // checks how many items are filtered and changes size for items
          filterCount = iso.filteredItems.length;
          filteredItems = iso.filteredItems;
          changeSize();
          iso.layout();
        }, 200)
      );
    });

    // change is-checked class on buttons
    $(".button-group").each(function (i, buttonGroup) {
      var $buttonGroup = $(buttonGroup);
      $buttonGroup.on("click", "button", function () {
        $buttonGroup.find(".is-checked").removeClass("is-checked");
        $(this).addClass("is-checked");
      });
    });

    // debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
      var timeout;
      threshold = threshold || 100;
      return function debounced() {
        clearTimeout(timeout);
        var args = arguments;
        var _this = this;
        function delayed() {
          fn.apply(_this, args);
        }
        timeout = setTimeout(delayed, threshold);
      };
    }

    // calculate isotope item width on resize
    window.addEventListener("resize", function () {
      const firstSearch = document.querySelector(".search1");
      const secondSearch = document.querySelector(".search2");
      if (buttonFilter == "*" && firstSearch.value == "" && secondSearch.value == "") {
        calcWidth();
      } else {
        changeSize();
      }
    });
    //

    // categories click on a smaller screen size

    const catBtn = document.querySelector(
      ".filters-section-modified__button-wrapper"
    );
    const hiddenCat = document.querySelector("#filters");
    let catWidth = hiddenCat.offsetWidth;

    window.addEventListener("resize", function () {
      catWidth = hiddenCat.offsetWidth;

      if (this.innerWidth > 1024) {
        gsap.set("#CatOpen", {
          opacity: 1,
        });
        gsap.set("#CatClose", {
          opacity: 0,
        });
        gsap.to(".isotope-grid", 0.3, {
          x: 0,
        });
        gsap.set(hiddenCat, {
          x: 0,
        });
        gsap.set("body, html", {
          overflowX: "initial",
        });
        hiddenCat.classList.remove("opened");
      } else {
        if (hiddenCat.classList.contains("opened")) {
          gsap.set(hiddenCat, {
            x: 0,
          });
          gsap.set(".isotope-grid", {
            x: catWidth,
          });
        } else {
          gsap.set(hiddenCat, {
            x: "-100%",
          });
        }
      }
    });

    catBtn.addEventListener("click", function () {
      if (!hiddenCat.classList.contains("opened")) {
        gsap.to("#CatOpen", 0.5, {
          opacity: 0,
        });
        gsap.to("#CatClose", 0.5, {
          opacity: 1,
        });
        gsap.to(".isotope-grid", 0.3, {
          x: catWidth,
        });
        gsap.to(hiddenCat, 0.3, {
          x: 0,
        });
        gsap.set("body, html", {
          overflowX: "hidden",
        });
        hiddenCat.classList.add("opened");
      } else {
        closeCat();
      }
    });

    function closeCat() {
      gsap.to("#CatOpen", 0.5, {
        opacity: 1,
      });
      gsap.to("#CatClose", 0.5, {
        opacity: 0,
      });
      gsap.to(".isotope-grid", 0.3, {
        x: 0,
      });
      gsap.to(hiddenCat, 0.3, {
        x: "-100%",
      });
      gsap.set("body, html", {
        overflowX: "initial",
      });
      hiddenCat.classList.remove("opened");
    }
  }
}

function pressSlider() {
  const slider = document.querySelector(".press-slider");
  if (slider) {
    let options = {
      freeScroll: true,
      wrapAround: true,
      pageDots: false,
      autoPlay: 5000,
      groupCells: true,
      pauseAutoPlayOnHover: false,
    };

    const mediaQueryTablet = window.matchMedia("(max-width: 768px)");
    if (mediaQueryTablet.matches) {
      options.prevNextButtons = false;
    }

    const mediaQueryMobile = window.matchMedia("(max-width: 600px)");
    if (mediaQueryMobile.matches) {
      options.pageDots = true;
      options.autoPlay = false;
      options.freeScroll = false;
    }

    flktySlider = new Flickity(".press-slider", options);
  }
}
