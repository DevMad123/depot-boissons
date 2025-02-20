@extends('backend.layouts.apps')
{{-- 
@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection --}}

@section('styles')
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.jpg') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/datatable.css') }}">
@endsection

@section('admin-content')
    <div class="page-header">
        <div class="page-title">
            <h4>Liste des Fournisseurs</h4>
            <h6>Gérez vos Fournisseurs</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.fournisseurs.create') }}" class="btn btn-added"><img
                    src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouveau
                Fournisseur</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('backend.layouts.composants.messages')
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('backend/assets/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a onclick="exporterEnPdf()" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="{{ asset('backend/assets/img/icons/pdf.svg') }}"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a onclick="exporterEnExcel()" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="excel"><img src="{{ asset('backend/assets/img/icons/excel.svg') }}"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a onclick="imprimerFacture()" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="print"><img src="{{ asset('backend/assets/img/icons/printer.svg') }}"
                                    alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive" id="facture">
                <table class="table  datanew table-striped" id="example">
                    <thead>
                        <tr>
                            <th>
                                N°
                            </th>
                            <th>N° matricule</th>
                            <th>Nom du fournisseur</th>
                            <th>E-mail</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Solde</th>
                            <th>Date de création</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fournisseurs as $fournisseurs)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $fournisseurs->matrifournisseur }}</td>
                                <td>{{ $fournisseurs->nom }}</td>
                                <td>{{ $fournisseurs->email }}</td>
                                <td>{{ $fournisseurs->telephone }}</td>
                                <td>{{ $fournisseurs->adresse }}</td>
                                <td>{{ $fournisseurs->solde }}</td>
                                <td>{{ \Carbon\Carbon::parse($fournisseurs->created_at)->format('d-m-Y à H:i') }}</td>
                                <td>
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    @if (auth()->user()->can('admin.edit'))
                                        <a class="me-3"
                                            href="{{ route('admin.fournisseurs.edit', $fournisseurs->id) }}"><img
                                                src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="img"></a>
                                    @endif
                                    @if (auth()->user()->can('admin.delete'))
                                        <a class="confirm-text" href="javascript:void(0);"
                                            onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir supprimer?')) { document.getElementById('delete-form-{{ $fournisseurs->id }}').submit(); }">
                                            <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>

                                        <form id="delete-form-{{ $fournisseurs->id }}"
                                            action="{{ route('admin.fournisseurs.destroy', $fournisseurs->id) }}"
                                            method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    {{-- <script>
        // EXPORTATION DES DONNES EN XLS 
        function exporterEnExcel() {
            let factureInfo = `
                <div class="page-title">
            <h4>Liste des Fournisseurs</h4>
            <h6>Gérez vos  Fournisseurs</h6>
        </div>
            `;

            let table = document.getElementById("tableFacture");
            let rows = table.getElementsByTagName("tr");

            let tableData = `<tr>
                            <th>
                                N°
                            </th>
                            <th>N° matricule</th>
                            <th >Nom du fournisseur</th>
                            <th >E-mail</th>
                            <th >Téléphone</th>
                            <th >Adresse</th>
                            <th >Solde</th>
                            <th >Date de création</th>
                        </tr>
            `;

            // Parcourir chaque ligne du tableau et exclure la colonne "Total (€)"
            for (let i = 1; i < rows.length; i++) { // Commence à 1 pour ignorer les en-têtes
                let cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0) {
                    tableData += `<tr>
                        <td>${cells[0].innerText}</td>
                        <td>${cells[1].innerText}</td>
                        <td>${cells[2].innerText}</td>
                        <td>${cells[3].innerText}</td>
                        <td>${cells[4].innerText}</td>
                        <td>${cells[5].innerText}</td>
                        <td>${cells[6].innerText}</td>
                        <td>${cells[7].innerText}</td>
                    </tr>`;
                }
            }

            let tableHtml = `
                <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid black; text-align: center; padding: 10px; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    ${factureInfo}
                    <table border="1">${tableData}</table>
                </body>
                </html>
            `;

            let blob = new Blob([tableHtml], {
                type: "application/vnd.ms-excel"
            });
            let url = URL.createObjectURL(blob);

            let a = document.createElement("a");
            a.href = url;
            a.download = "facture.xls";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }


        //EXPORTATION DES DONNES EN PDF 

        function exporterEnPdf() {
            let factureHTML = document.getElementById("facture").cloneNode(true);

    // Supprimer la colonne "Total (€)"
    let table = factureHTML.querySelector("table");
    let rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        rows[i].removeChild(rows[i].lastElementChild); // Supprime la dernière colonne (Total)
    }

    // Convertir l'élément HTML en image avec html2canvas
    html2canvas(factureHTML, { scale: 2 }).then(canvas => {
        let imgData = canvas.toDataURL("image/png");

        // Créer un document PDF avec jsPDF
        const { jsPDF } = window.jspdf;
        let pdf = new jsPDF("p", "mm", "a4");

        let imgWidth = 190; // Largeur en mm pour le PDF
        let pageHeight = 297; // Hauteur d'une page A4 en mm
        let imgHeight = (canvas.height * imgWidth) / canvas.width;
        let position = 10; // Position initiale

        pdf.addImage(imgData, "PNG", 10, position, imgWidth, imgHeight);

        // Télécharger le fichier PDF
        pdf.save("facture.pdf");
    });
        }

        // IMPRIMER

        function imprimerFacture() {
            let factureHTML = document.getElementById("facture").cloneNode(true);

            // Supprimer la colonne "Total (€)"
            let table = factureHTML.querySelector("table");
            let rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                rows[i].removeChild(rows[i].lastElementChild); // Supprime la dernière colonne (Total)
            }

            let win = window.open('', '', 'width=800,height=600');
            win.document.write('<html><head><title>Facture</title>');
            win.document.write('<style>');
            win.document.write('table { width: 100%; border-collapse: collapse; }');
            win.document.write('th, td { border: 1px solid black; text-align: center; padding: 10px; }');
            win.document.write('th { background-color: #f2f2f2; }');
            win.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
            win.document.write('</style></head><body>');
            win.document.write(factureHTML.outerHTML);
            win.document.write('</body></html>');
            win.document.close();
            win.print();
        }
    </script> --}}
    <script>
        // EXPORTER EN EXCEL
        function exporterEnExcel() {
            let table = document.getElementById("example").cloneNode(true);

            // Supprimer la dernière colonne "Action"
            let rows = table.getElementsByTagName("tr");
            for (let i = 0; i < rows.length; i++) {
                rows[i].removeChild(rows[i].lastElementChild);
            }

            let tableHtml = `
                <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid black; text-align: center; padding: 10px; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h2>Liste des Fournisseurs</h2>
                    ${table.outerHTML}
                </body>
                </html>
            `;

            let blob = new Blob([tableHtml], {
                type: "application/vnd.ms-excel"
            });
            let url = URL.createObjectURL(blob);

            let a = document.createElement("a");
            a.href = url;
            a.download = "Fournisseurs.xls";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        // EXPORTER EN PDF
        function exporterEnPdf() {
            let factureHTML = document.getElementById("facture").cloneNode(true);

            // Supprimer la colonne "Action"
            let table = factureHTML.querySelector("table");
            let rows = table.getElementsByTagName("tr");
            for (let i = 0; i < rows.length; i++) {
                rows[i].removeChild(rows[i].lastElementChild);
            }
            let factureModifieeHTML = factureHTML.innerHTML;
            // Configuration des options pour le PDF
            var opt = {
                margin: 1,
                filename: 'Fournisseurs.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'landscape'
                }
            };

            // Utilisation de html2pdf pour générer le PDF
            html2pdf().set(opt).from(factureHTML).save();
        }



        // IMPRIMER
        function imprimerFacture() {
            let factureHTML = document.getElementById("facture").cloneNode(true);

            // Supprimer la colonne "Action"
            let table = factureHTML.querySelector("table");
            let rows = table.getElementsByTagName("tr");
            for (let i = 0; i < rows.length; i++) {
                rows[i].removeChild(rows[i].lastElementChild);
            }

            let win = window.open('', '', 'width=800,height=600');
            win.document.write('<html><head><title>Liste des Fournisseurs</title>');
            win.document.write('<style>');
            win.document.write('table { width: 100%; border-collapse: collapse; }');
            win.document.write('th, td { border: 1px solid black; text-align: center; padding: 10px; }');
            win.document.write('th { background-color: #f2f2f2; }');
            win.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
            win.document.write('</style></head><body>');
            win.document.write('<h2>Liste des Fournisseurs</h2>');
            win.document.write(factureHTML.outerHTML);
            win.document.write('</body></html>');
            win.document.close();
            win.print();
        }
    </script>
@endsection
