Drupal.behaviors.devBehavior = {
  attach: function (context, settings) {
    // Use context to filter the DOM to only the elements of interest,
    // and use once() to guarantee that our callback function processes
    // any given element one time at most, regardless of how many times
    // the behaviour itself is called (it is not sufficient in general
    // to assume an element will only ever appear in a single context).
    // once('myCustomBehavior', 'input.myCustomBehavior', context).forEach(
    //   function (element) {
    //     element.classList.add('processed');
    //   }
    // );
    // console.log(context);
    // console.log(settings);
    let divContainer = document.getElementById('block-titulodelapagina');
    if(divContainer){
      divContainer.innerHTML = '<button id="devButton" class="devButton">Click Here</button>';
      let button = document.getElementById('devButton')
      button.addEventListener('click', function(){
        let siteName = document.querySelectorAll('.site-name');
        alert(siteName[0].innerText);
      });
    }
    
  }
};
