jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionHolderIngredients = $('ul.ingredients');
    var $collectionHolderSteps = $('ul.steps');
  
    $collectionHolderIngredients.find('li').each(function() {
      addTagFormDeleteLink($(this));
    });
    $collectionHolderSteps.find('li').each(function() {
      addTagFormDeleteLink($(this));
    });
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolderIngredients.data('index', $collectionHolderIngredients.find('input').length);
    $collectionHolderSteps.data('index', $collectionHolderSteps.find('input').length);
  
    $('body').on('click', '.add_item_link1', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    })
    $('body').on('click', '.add_item_link2', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    })
  });
  
  function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('.' + $collectionHolderClass);
  
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
  
    // get the new index
    var index = $collectionHolder.data('index');
  
    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);
  
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);
  
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
  
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi)
    addTagFormDeleteLink($newFormLi);
  }
  
  function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">Remove</button>');
    $tagFormLi.append($removeFormButton);
  
    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
  }