@include('layout')
<head>
    <link href="{{asset('css/plannerGroup.css')}}" rel="stylesheet">
    <link href="{{asset('css/plannerSolo.css')}}" rel="stylesheet">
</head>


<form id="regForm" action="/planner/groupSave" method="POST">
    {{csrf_field()}}
    <h1>Group Planner:</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">Date:
        <p><input type="date" oninput="this.className = ''" name="pdate"></p>
    </div>
    <div class="tab">Select Time:
        <p><input type="time" placeholder="Start time" oninput="this.className = ''" name="startT"></p>
        <p><input type="time" placeholder="End time" oninput="this.className = ''" name="endT"></p>
    </div>
    <div class="tab">Select TeamMembers:
        <select class="custom-select" oninput="this.className = ''" name="users[]" multiple>
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
{{--

<script>
    //Fraud
    var $ = {
        get: function (selector) {
            var ele = document.querySelectorAll(selector);
            for (var i = 0; i < ele.length; i++) {
                this.init(ele[i]);
            }
            return ele;
        },
        template: function (html) {
            var template = document.createElement('div');
            template.innerHTML = html.trim();
            return this.init(template.childNodes[0]);
        },
        init: function (ele) {
            ele.on = function (event, func) {
                this.addEventListener(event, func);
            }
            return ele;
        }
    };

    //Build the plugin
    var drop = function (info) {
        var o = {
            options: info.options,
            selected: info.selected || [],
            preselected: info.preselected || [],
            open: false,
            html: {
                select: $.get(info.selector)[0],
                options: $.get(info.selector + ' option'),
                parent: undefined,
            },
            init: function () {
                //Setup Drop HTML
                this.html.parent = $.get(info.selector)[0].parentNode
                this.html.drop = $.template('<div class="drop"></div>')
                this.html.dropDisplay = $.template('<div class="drop-display">Display</div>')
                this.html.dropOptions = $.template('<div class="drop-options">Options</div>')
                this.html.dropScreen = $.template('<div class="drop-screen"></div>')

                //Getting interesting
                this.html.parent.insertBefore(this.html.drop, this.html.select)
                this.html.drop.appendChild(this.html.dropDisplay)
                this.html.drop.appendChild(this.html.dropOptions)
                this.html.drop.appendChild(this.html.dropScreen)
                //Hide old select
                this.html.drop.appendChild(this.html.select);

                //Core Events
                var that = this;
                this.html.dropDisplay.on('click', function () {
                    that.toggle()
                });
                this.html.dropScreen.on('click', function () {
                    that.toggle()
                });
                //Run Render
                this.load()
                this.preselect()
                this.render();
            },
            toggle: function () {
                this.html.drop.classList.toggle('open');
            },
            addOption: function (e, element) {
                var index = Number(element.dataset.index);
                this.clearStates()
                this.selected.push({
                    index: Number(index),
                    state: 'add',
                    removed: false
                })
                this.options[index].state = 'remove';
                this.render()
            },
            removeOption: function (e, element) {
                e.stopPropagation();
                this.clearStates()
                var index = Number(element.dataset.index);
                this.selected.forEach(function (select) {
                    if (select.index == index && !select.removed) {
                        select.removed = true
                        select.state = 'remove'
                    }
                })
                this.options[index].state = 'add'
                this.render();
            },
            load: function () {
                this.options = [];
                for (var i = 0; i < this.html.options.length; i++) {
                    var option = this.html.options[i]
                    this.options[i] = {
                        html: option.innerHTML,
                        value: option.value,
                        selected: option.selected,
                        state: ''
                    }
                }
            },
            preselect: function () {
                var that = this;
                this.selected = [];
                this.preselected.forEach(function (pre) {
                    that.selected.push({
                        index: pre,
                        state: 'add',
                        removed: false
                    })
                    that.options[pre].state = 'remove';
                })
            },
            render: function () {
                this.renderDrop()
                this.renderOptions()
            },
            renderDrop: function () {
                var that = this;
                var parentHTML = $.template('<div></div>')
                this.selected.forEach(function (select, index) {
                    var option = that.options[select.index];
                    var childHTML = $.template('<span class="item ' + select.state + '">' + option.html + '</span>')
                    var childCloseHTML = $.template(
                        '<i class="material-icons btnclose" data-index="' + select.index + '">&#xe5c9;</i></span>')
                    childCloseHTML.on('click', function (e) {
                        that.removeOption(e, this)
                    })
                    childHTML.appendChild(childCloseHTML)
                    parentHTML.appendChild(childHTML)
                })
                this.html.dropDisplay.innerHTML = '';
                this.html.dropDisplay.appendChild(parentHTML)
            },
            renderOptions: function () {
                var that = this;
                var parentHTML = $.template('<div></div>')
                this.options.forEach(function (option, index) {
                    var childHTML = $.template(
                        '<a data-index="' + index + '" class="' + option.state + '">' + option.html + '</a>')
                    childHTML.on('click', function (e) {
                        that.addOption(e, this)
                    })
                    parentHTML.appendChild(childHTML)
                })
                this.html.dropOptions.innerHTML = '';
                this.html.dropOptions.appendChild(parentHTML)
            },
            clearStates: function () {
                var that = this;
                this.selected.forEach(function (select, index) {
                    select.state = that.changeState(select.state)
                })
                this.options.forEach(function (option) {
                    option.state = that.changeState(option.state)
                })
            },
            changeState: function (state) {
                switch (state) {
                    case 'remove':
                        return 'hide'
                    case 'hide':
                        return 'hide'
                    default:
                        return ''
                }
            },
            isSelected: function (index) {
                var check = false
                this.selected.forEach(function (select) {
                    if (select.index == index && select.removed == false) check = true
                })
                return check
            }
        };
        o.init();
        return o;
    }


    //The loot you are acutally looking for
    //Run Please
    var myDrop = new drop({
        selector: '#myMulti',

    });
    myDrop.toggle();

</script>--}}
