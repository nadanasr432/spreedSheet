<!DOCTYPE html>
<html>

<head>
    <title>Excel-Like Table</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Apply styles to the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #444242;
            text-align: left;
            padding: 8px;
        }

        /* Alternate row colors */
        tbody tr:nth-child(odd) {
            background-color: #bd8dbd;
        }

        tbody tr:nth-child(even) {
            background-color: #e495e4;
        }

        /* Style for table header */
        th {
            background-color: #ddc9d8;
            color: rgb(9, 9, 9);
        }

        /* Input fields inside cells */
        input[type="text"] {
            width: 100%;
            border: none;
            background: transparent;
        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <form id="data-form">
        <table>
            <!-- Header Row -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>

                </tr>
            </thead>

            <!-- Data Rows -->
            <tbody>
                <tr>
                    <td><input type="text" id="name"></td>
                    <td><input type="text" id="phone"></td>
                    <td><input type="text" id="address"></td>
                   
            
                </tr>
                @foreach($spreadsheets as $spreadsheet)
                <tr>
                    <td><input type="text" id="name" value="{{ $spreadsheet->name }}"></td>
                    <td><input type="text" id="phone" value="{{ $spreadsheet->phone }}"></td>
                    <td><input type="text" id="address" value="{{ $spreadsheet->address }}"></td>
                </tr>
            @endforeach
              
            </tbody>
        </table>
    </form>
    
<button id="addRow">Add Row</button>

<script>
    $(document).ready(function () {
        // Function to handle saving data
        function saveData(name, phone, address) {
            $.ajax({
                url: "{{ route('insert') }}",
                type: "POST",
                data: {
                    name: name,
                    phone: phone,
                    address: address,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                success: function () {
                    // Data saved successfully, you can perform any desired actions here
                    // For example, you can show a success message
                    console.log("Data saved successfully!");
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    console.error("Error saving data: " + error);
                }
            });
        }

        // Add event listeners to input fields
        $("#name, #phone, #address").on("change", function () {
            // Get the data from input fields
            var name = $("#name").val();
            var phone = $("#phone").val();
            var address = $("#address").val();

            // Call the saveData function to save the data
            saveData(name, phone, address);
        });

        // Add event listener to the "Add Row" button
        $("#addRow").on("click", function () {
            // Clone the last row in the table (including input fields)
            var newRow = $("table tbody tr:last").clone();

            // Clear the input fields in the new row
            newRow.find("input[type='text']").val("");

            // Append the new row to the table
            $("table tbody").append(newRow);

            // Add event listeners to the new row's input fields
            newRow.find("input[type='text']").on("change", function () {
                var name = newRow.find("#name").val();
                var phone = newRow.find("#phone").val();
                var address = newRow.find("#address").val();

                // Call the saveData function to save the data for the new row
                saveData(name, phone, address);
            });
        });
    });
</script>

    
</body>

</html>
