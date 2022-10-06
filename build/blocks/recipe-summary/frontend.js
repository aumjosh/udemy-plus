/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./src/blocks/recipe-summary/frontend.js ***!
  \***********************************************/
document.addEventListener('DOMContentLoaded', () => {
  const block = document.querySelector('#recipe-rating'); // data attributes are stored in an object called 'dataset'
  // we can reference a data attribute by it's name exluding the data prefix
  // the browser will handle storing an element's data attributes into an object
  // the name gets converted into camel case
  // the dash gets removed from the name
  // (so post-id gets converted into postId)
  // ~~ data attributes get stored as string
  // ~~ so we must parse them into the approprate datatypes
  // ~~ to match the database's datatypes
  // ~~ which are - Integer, Float, Boolean

  const postID = parseInt(block.dataset.postId); // avg-rating gets converted to avgRating
  // also matching the float datatype in the db

  const avgRating = block.dataset.avgRating ? parseFloat(block.dataset.avgRating) : 0; // converting to boolean value using !!

  const loggedIn = !!block.dataset.loggedIn;
  console.log(postID, avgRating, loggedIn);
});
/******/ })()
;
//# sourceMappingURL=frontend.js.map