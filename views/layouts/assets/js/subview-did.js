subview('main', {
    /*** Life-Cycle Methods ***/
    once: function() {
        //Runs the first time a subview is created then never again.
    },
    init: function() {
        //Runs when initializing a subview via the .spawn method
    },
    clean: function() {
        //Runs when a subview is removed to clean and prepare it to be reused
    },
    /*** Templating ***/
    template: Handlebars.compile("\
        Hello World!\
        This  is !\
        }\
    "),
    subviews: {     //Subviews that will be available in the template
        content: SomeSubview
    },
    data: {         //Data available in the template (may also be a function)
        adjective:  "excellent",
        noun:       "framework"
    },
    /*** Extensions ***/
    myExtension: myExtension({

    }),
    /*** My View's API ***/

    // ... Some API Functions
});
