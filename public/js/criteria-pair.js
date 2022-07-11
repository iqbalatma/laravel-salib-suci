onClickBtnRank = (criteriaPriority, subCriteriaSubPriority, subCriteriaSet) => {
    $("#btn-rank").on("click", function () {
        const matrixAlternative = [];
        const alternativeSet = [];

        $("#table-criteria-alternative > tbody > tr").each(function () {
            alternativeSet.push($(this).find("td").eq(0).text());

            const row = [];
            const columnLength = $(this).children().length;
            for (let index = 1; index < columnLength; index++) {
                const subCriteriaValue = $(this).find("td").eq(index).text();
                const indexSubCriteria =
                    subCriteriaSet.indexOf(subCriteriaValue);

                const value =
                    criteriaPriority[index - 1] *
                    subCriteriaSubPriority[indexSubCriteria];
                row.push(value);
            }
            matrixAlternative.push(row);
        });

        const finalResult = [];
        matrixAlternative.forEach((item, index) => {
            let sum = item.reduce(function (previousValue, currentValue) {
                return previousValue + currentValue;
            });

            finalResult.push({
                alternative: alternativeSet[index],
                sum,
            });
        });

        finalResult.sort(function (a, b) {
            return b.sum - a.sum;
        });

        var rank = 1;
        for (var i = 0; i < finalResult.length; i++) {
            if (i > 0 && finalResult[i].sum < finalResult[i - 1].sum) {
                rank++;
            }
            finalResult[i].rank = rank;
        }

        $("#table-rank tbody").empty();

        finalResult.forEach((element) => {
            const markUp = `
        <tr>
            <td>${element.alternative}
            <td>${element.sum}
            <td>${element.rank}
        </tr>
        `;
            $("#table-rank tbody").append(markUp);
        });

        drawChart(finalResult);
    });
};

drawChart = (finalResult) => {
    $("#chart-row").removeClass("d-none");
    const label = finalResult.map((item) => item.alternative);
    const sum = finalResult.map((item) => item.sum);
    const ctx = document.getElementById("myChart").getContext("2d");
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: label,
            datasets: [
                {
                    data: sum,
                    backgroundColor: [
                        "rgba(255, 99, 132)",
                        "rgba(54, 162, 235)",
                        "rgba(255, 206, 86)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
};

drawSummaryCard = ({
    criteriaPriority,
    subCriteriaSubPriority,
    subCriteriaSet,
    ci,
    cr,
    ri,
}) => {
    $("#ci").text(ci);
    $("#ri").text(ri);
    $("#cr").text(cr);
    if (cr > 0.1) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Nilai Consistency Ration Lebih dari 0.1 !",
        });
        $("#summary-alert")
            .removeClass("alert-primary")
            .addClass("alert-danger")
            .text(
                "Nilai Consistency Ration Lebih dari 0.1, lakukan pembobotan ulang"
            );
    } else {
        Swal.fire(
            "Berhasil !",
            "Nilai consistency ratio dapat diterima !",
            "success"
        );

        $("#summary-alert")
            .removeClass("alert-danger")
            .addClass("alert-success")
            .text("Nilai consistency ratio dapat diterima !");

        $("#sub-criteria").removeClass("d-none");
        onClickBtnRank(
            criteriaPriority,
            subCriteriaSubPriority,
            subCriteriaSet
        );
    }
};

$("#btn-setting").on("click", function () {
    const selectedRow = $("#select-row option:selected").val();
    const selectedColumn = $("#select-column option:selected").val();
    const criteriaPairValue = $(
        "#select-criteria-pair-value option:selected"
    ).val();

    if (selectedColumn == "") {
        return Swal.fire({
            title: "Error!",
            text: "Kolom kriteria belum dipilih !",
            icon: "error",
        });
    }
    if (selectedRow == "") {
        return Swal.fire({
            title: "Error!",
            text: "Baris kriteria belum dipilih !",
            icon: "error",
        });
    }
    if (criteriaPairValue == "") {
        return Swal.fire({
            title: "Error!",
            text: "Nilai pasangan kriteria belum dipilih belum dipilih !",
            icon: "error",
        });
    }

    $(`#baris${selectedRow}-kolom${selectedColumn}`).text(criteriaPairValue);
    $(`#baris${selectedColumn}-kolom${selectedRow}`).text(
        1 / criteriaPairValue
    );
});

$("#btn-setting-kriteria-value").on("click", function () {
    const selectAlternative = $(
        "#select-row-alternative option:selected"
    ).val();
    const selectCriteria = $("#select-column-criteria option:selected").val();
    const selectCriteriaValue = $(
        "#select-criteria-value option:selected"
    ).val();
    if (selectAlternative == "") {
        return Swal.fire({
            title: "Error!",
            text: "Nama alternative belum dipilih !",
            icon: "error",
        });
    }
    if (selectCriteria == "") {
        return Swal.fire({
            title: "Error!",
            text: "Kriteria belum dipilih !",
            icon: "error",
        });
    }

    if (selectCriteriaValue == "") {
        return Swal.fire({
            title: "Error!",
            text: "Nilai pasangan kriteria belum dipilih belum dipilih !",
            icon: "error",
        });
    }

    $(
        `#baris-subcriteria${selectAlternative}-kolom-subcriteria${selectCriteria}`
    ).text(selectCriteriaValue);
});

$("#btn-calculate").on("click", function () {
    const matrix = [];
    $("#table-criteria > tbody > tr").each(function () {
        const row = [];
        const columnLength = $(this).children().length;
        for (let index = 1; index < columnLength; index++) {
            row.push($(this).find("td").eq(index).text());
        }
        matrix.push(row);
    });

    $.ajax({
        method: "POST",
        url: "/api/calculate",
        data: { matrix },
    }).done((response) => {
        drawSummaryCard(response);
    });
});

[
    {
        alternative: "iqbal atma muliawan",
        sum: 0.9999999999999999,
        rank: 1,
    },
    {
        alternative: "saleh budiman",
        sum: 0.5465290829916609,
        rank: 2,
    },
];
