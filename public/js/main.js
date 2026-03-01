(function ($) {
    "use strict";

    var initCustomSelects = function () {
        var selects = document.querySelectorAll('select.form-select, select.input');
        if (!selects.length) {
            return;
        }
        var wrappers = [];

        var closeAll = function (except) {
            wrappers.forEach(function (wrapper) {
                if (wrapper !== except) {
                    wrapper.classList.remove('is-open');
                }
            });
        };

        selects.forEach(function (select) {
            if (select.dataset.customSelect === 'true') {
                return;
            }
            select.dataset.customSelect = 'true';

            var wrapper = document.createElement('div');
            wrapper.className = 'custom-select';
            if (select.disabled) {
                wrapper.classList.add('is-disabled');
            }

            select.parentNode.insertBefore(wrapper, select);
            wrapper.appendChild(select);
            select.classList.add('custom-select-native');

            var trigger = document.createElement('button');
            trigger.type = 'button';
            trigger.className = 'custom-select-trigger';
            trigger.textContent = select.options[select.selectedIndex] ? select.options[select.selectedIndex].textContent : 'Chọn';
            trigger.disabled = select.disabled;
            wrapper.appendChild(trigger);

            var list = document.createElement('div');
            list.className = 'custom-select-list';

            Array.from(select.options).forEach(function (option) {
                var optionBtn = document.createElement('button');
                optionBtn.type = 'button';
                optionBtn.className = 'custom-select-option';
                optionBtn.textContent = option.textContent;
                optionBtn.dataset.value = option.value;
                if (option.disabled) {
                    optionBtn.disabled = true;
                }
                if (option.selected) {
                    optionBtn.classList.add('is-selected');
                }
                optionBtn.addEventListener('click', function () {
                    if (option.disabled) {
                        return;
                    }
                    select.value = option.value;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    wrapper.classList.remove('is-open');
                    closeAll();
                });
                list.appendChild(optionBtn);
            });

            wrapper.appendChild(list);
            wrappers.push(wrapper);

            trigger.addEventListener('click', function (event) {
                event.stopPropagation();
                var willOpen = !wrapper.classList.contains('is-open');
                closeAll(wrapper);
                wrapper.classList.toggle('is-open', willOpen);
            });

            select.addEventListener('change', function () {
                var selectedOption = select.options[select.selectedIndex];
                trigger.textContent = selectedOption ? selectedOption.textContent : 'Chọn';
                list.querySelectorAll('.custom-select-option').forEach(function (btn) {
                    btn.classList.toggle('is-selected', btn.dataset.value === select.value);
                });
            });
        });

        document.addEventListener('click', function () {
            closeAll();
        });
    };

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    // Chart Global Color
    if (window.Chart) {
        Chart.defaults.color = "#6C7293";
        Chart.defaults.borderColor = "#000000";
    }


    // Worldwide Sales Chart
    var ctx1El = $("#worldwide-sales").get(0);
    if (window.Chart && ctx1El) {
        var ctx1 = ctx1El.getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
                datasets: [{
                        label: "USA",
                        data: [15, 30, 55, 65, 60, 80, 95],
                        backgroundColor: "rgba(235, 22, 22, .7)"
                    },
                    {
                        label: "UK",
                        data: [8, 35, 40, 60, 70, 55, 75],
                        backgroundColor: "rgba(235, 22, 22, .5)"
                    },
                    {
                        label: "AU",
                        data: [12, 25, 45, 55, 65, 70, 60],
                        backgroundColor: "rgba(235, 22, 22, .3)"
                    }
                ]
                },
            options: {
                responsive: true
            }
        });
    }


    // Salse & Revenue Chart
    var ctx2El = $("#salse-revenue").get(0);
    if (window.Chart && ctx2El) {
        var ctx2 = ctx2El.getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
                datasets: [{
                        label: "Salse",
                        data: [15, 30, 55, 45, 70, 65, 85],
                        backgroundColor: "rgba(235, 22, 22, .7)",
                        fill: true
                    },
                    {
                        label: "Revenue",
                        data: [99, 135, 170, 130, 190, 180, 270],
                        backgroundColor: "rgba(235, 22, 22, .5)",
                        fill: true
                    }
                ]
                },
            options: {
                responsive: true
            }
        });
    }
    


    // Single Line Chart
    var ctx3El = $("#line-chart").get(0);
    if (window.Chart && ctx3El) {
        var ctx3 = ctx3El.getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
                datasets: [{
                    label: "Salse",
                    fill: false,
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15]
                }]
            },
            options: {
                responsive: true
            }
        });
    }


    // Single Bar Chart
    var ctx4El = $("#bar-chart").get(0);
    if (window.Chart && ctx4El) {
        var ctx4 = ctx4El.getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "bar",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });
    }


    // Pie Chart
    var ctx5El = $("#pie-chart").get(0);
    if (window.Chart && ctx5El) {
        var ctx5 = ctx5El.getContext("2d");
        var myChart5 = new Chart(ctx5, {
            type: "pie",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });
    }


    // Doughnut Chart
    var ctx6El = $("#doughnut-chart").get(0);
    if (window.Chart && ctx6El) {
        var ctx6 = ctx6El.getContext("2d");
        var myChart6 = new Chart(ctx6, {
            type: "doughnut",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomSelects);
    } else {
        initCustomSelects();
    }
    
})(jQuery);
