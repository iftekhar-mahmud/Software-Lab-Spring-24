chrome.app.runtime.onLaunched.addListener(function() {
  chrome.app.window.('localhost/Climslara/public/index.php', {
    'outerBounds': {
      'width': 400,
      'height': 500
    }
  });
});