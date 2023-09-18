// {{-- Toggle phases table --}}

// phase1
const phase1Section = document.getElementById("phase1Section");
const phase1Table = document.getElementById("phase1Table");

phase1Section.addEventListener("click", () => {
    if (phase1Table.style.display === "none") {
        phase1Table.style.display = "block";
    } else {
        phase1Table.style.display = "none";
    }
});

// phase2
const phase2Section = document.getElementById("phase2Section");
const phase2Table = document.getElementById("phase2Table");

phase2Section.addEventListener("click", () => {
    if (phase2Table.style.display === "none") {
        phase2Table.style.display = "block";
    } else {
        phase2Table.style.display = "none";
    }
});

// phase3
const phase3Section = document.getElementById("phase3Section");
const phase3Table = document.getElementById("phase3Table");

phase3Section.addEventListener("click", () => {
    if (phase3Table.style.display === "none") {
        phase3Table.style.display = "block";
    } else {
        phase3Table.style.display = "none";
    }
});

// project1
const project1Section = document.getElementById("project1Section");
const project1Table = document.getElementById("project1Table");

if (project1Section) {
    project1Section.addEventListener("click", () => {
        if (project1Table.style.display === "none") {
            project1Table.style.display = "block";
        } else {
            project1Table.style.display = "none";
        }
    });
}

// project2
const project2Section = document.getElementById("project2Section");
const project2Table = document.getElementById("project2Table");

if (project2Section) {
project2Section.addEventListener("click", () => {
    if (project2Table.style.display === "none") {
        project2Table.style.display = "block";
    } else {
        project2Table.style.display = "none";
    }
});
}

$(document).ready(function () {
    // Initialize Tippy.js tooltips
    tippy("[data-tippy-content]", {
        arrow: true,
        animation: "scale",
        hideOnClick: true,
        maxWidth: 250,
        moveTransition: "transform 0.2s ease-out",
        offset: [0, 12],
        theme: "white-red",
    });
    // Prevent form submission on enter click
    $("form").on("keydown", function (e) {
        // Check if the key pressed is Enter (key code 13)
        if (e.keyCode == 13) {
            // Prevent the default behavior (form submission)
            e.preventDefault();
        }
    });

    // Select all rows
    var rows = $("tbody tr");

    // Add event listeners to Examiner input fields
    rows.find(".examiner-input").on("input", function () {
        validateExaminerMarks(this);
        calculateAverage(this);
        calculateTotal();
    });

    // Add event listeners to all input fields (including attendance, development, and report preparation)
    rows.find("input").on("input", function () {
        calculateTotal();
    });

    // Function to calculate and update the Examiner Average for a specific row
    function calculateAverage(inputField) {
        var row = $(inputField).closest("tr");
        var examiner1 =
            parseFloat(row.find(".examiner-input:eq(0)").val()) || 0;
        var examiner2 =
            parseFloat(row.find(".examiner-input:eq(1)").val()) || 0;
        var examiner3 =
            parseFloat(row.find(".examiner-input:eq(2)").val()) || 0;
        var average = ((examiner1 + examiner2 + examiner3) / 300) * 40;
        row.find(".examiner-average").val(average.toFixed(2));
    }

    // Function to calculate and update the Total for all rows
    function calculateTotal() {
        rows.each(function (index, row) {
            var examiner1 =
                parseFloat($(row).find(".examiner-input:eq(0)").val()) || 0;
            var examiner2 =
                parseFloat($(row).find(".examiner-input:eq(1)").val()) || 0;
            var examiner3 =
                parseFloat($(row).find(".examiner-input:eq(2)").val()) || 0;
            var average = ((examiner1 + examiner2 + examiner3) / 300) * 40;

            var attendance =
                parseFloat($(row).find("input[name='attendance[]']").val()) ||
                0;
            var development =
                parseFloat(
                    $(row).find("input[name='project_development[]']").val()
                ) || 0;
            var reportPreparation =
                parseFloat(
                    $(row).find("input[name='report_preparation[]']").val()
                ) || 0;

            // Calculate Total
            var total = average + attendance + development + reportPreparation;
            $(row).find(".total-input").val(total.toFixed(2));
        });
    }

    // Add an event listener for input change
    document
        .querySelectorAll('input[name="examiner_1_mark[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateExaminerMarks(this);
                calculateTotals(this.closest("tr"));
            });
        });

    document
        .querySelectorAll('input[name="examiner_2_mark[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateExaminerMarks(this);
                calculateTotals(this.closest("tr"));
            });
        });

    document
        .querySelectorAll('input[name="examiner_3_mark[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateExaminerMarks(this);
                calculateTotals(this.closest("tr"));
            });
        });

    document
        .querySelectorAll('input[name="attendance[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateAttendance(this);
                calculateTotals(this.closest("tr"));
            });
        });

    document
        .querySelectorAll('input[name="project_development[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateProjectDevelopment(this);
                calculateTotals(this.closest("tr"));
            });
        });

    document
        .querySelectorAll('input[name="report_preparation[]"]')
        .forEach(function (input) {
            input.addEventListener("input", function () {
                validateReportPreparation(this);
                calculateTotals(this.closest("tr"));
            });
        });

    // Function to validate Examiner Marks
    function validateExaminerMarks(inputField) {
        var value = parseFloat($(inputField).val());
        var errorMessage = "";

        if (isNaN(value) || value < 0 || value > 100) {
            errorMessage = "Examiner marks must be between 0 and 100.";
            // Set the tooltip content
            $(inputField).attr("data-tippy-content", errorMessage);

            // Trigger the tooltip manually
            tippy(inputField).show();
        } else {
            // Remove the tooltip content and hide the tooltip
            $(inputField).attr("data-tippy-content", "");
            tippy(inputField).hide();
        }
    }
    // Function to validate Attendance Marks
    function validateAttendance(inputField) {
        var value = parseFloat($(inputField).val());
        var errorMessage = "";

        if (isNaN(value) || value < 0 || value > 10) {
            errorMessage = "Attendance must be between 0 and 10.";
            // Set the tooltip content
            $(inputField).attr("data-tippy-content", errorMessage);

            // Trigger the tooltip manually
            tippy(inputField).show();
        } else {
            // Remove the tooltip content and hide the tooltip
            $(inputField).attr("data-tippy-content", "");
            tippy(inputField).hide();
        }
    }

    // Function to validate Project Development Marks
    function validateProjectDevelopment(inputField) {
        var value = parseFloat($(inputField).val());
        var errorMessage = "";

        if (isNaN(value) || value < 0 || value > 30) {
            errorMessage = "Project development must be between 0 and 30.";
            // Set the tooltip content
            $(inputField).attr("data-tippy-content", errorMessage);

            // Trigger the tooltip manually
            tippy(inputField).show();
        } else {
            // Remove the tooltip content and hide the tooltip
            $(inputField).attr("data-tippy-content", "");
            tippy(inputField).hide();
        }
    }

    // Function to validate Report Preparation Marks
    function validateReportPreparation(inputField) {
        var value = parseFloat($(inputField).val());
        var errorMessage = "";

        if (isNaN(value) || value < 0 || value > 20) {
            errorMessage = "Report preparation must be between 0 and 20.";
            // Set the tooltip content
            $(inputField).attr("data-tippy-content", errorMessage);

            // Trigger the tooltip manually
            tippy(inputField).show();
        } else {
            // Remove the tooltip content and hide the tooltip
            $(inputField).attr("data-tippy-content", "");
            tippy(inputField).hide();
        }
    }

    function clearValidationError(input) {
        var errorMessage = input.closest("td").querySelector(".error-message");
        errorMessage.style.display = "none";
    }
});

// result Publish
