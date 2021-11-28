// jQuery on an empty object, we are going to use this as our queue
var ajaxQueue = $({});

$.ajaxQueue = function(ajaxOpts) {
  // Hold the original complete function
  var oldComplete = ajaxOpts.complete;

  // Queue our ajax request
  ajaxQueue.queue(function(next) {
    // Create a complete callback to invoke the next event in the queue
    ajaxOpts.complete = function() {
      // Invoke the original complete if it was there
      if (oldComplete) {
        oldComplete.apply(this, arguments);
      }

      // Run the next query in the queue
      next();
    };

    // Run the query
    $.ajax(ajaxOpts);
  });
};