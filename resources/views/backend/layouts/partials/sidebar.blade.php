 <!-- sidebar menu area start -->
 <!-- Menu bar -->
 <div class="sidebar" id="sidebar">
     <div class="sidebar-inner slimscroll">
         <div id="sidebar-menu" class="sidebar-menu">
             <ul>
                 <li class="active">
                     <a href="{{ route('admin.dashboard') }}"><img
                             src="{{ asset('backend/assets/img/icons/dashboard.svg') }}" alt="img"><span> Tableau de
                             bord</span> </a>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/product.svg') }}"
                             alt="img"><span> Produit</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.produits.create') }}">Ajouter Produit</a></li>
                         <li><a href="{{ route('admin.produits.index') }}">Liste des Produits</a></li>
                         <li><a href="{{ route('admin.emballages.create') }}">Ajouter Emballage</a></li>
                         <li><a href="{{ route('admin.emballages.index') }}">Liste des Emballages</a></li>
                         <li><a href="{{ route('admin.tailles.create') }}">Ajouter capacité</a></li>
                         <li><a href="{{ route('admin.tailles.index') }}">Liste Capacités</a></li>
                         <li><a href="{{ route('admin.roles.create') }}">Ajouter type produit</a></li>
                         <li><a href="{{ route('admin.typeproduits.index') }}">Liste types produits</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/sales1.svg') }}"
                             alt="img"><span> Ventes</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.traitementventes.create') }}">Ajouter Ventes</a></li>
                         <li><a href="{{ route('admin.ventes.index') }}">Liste des Ventes</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/purchase1.svg') }}"
                             alt="img"><span> Approvisionnement</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.approvisionnements.create') }}">Faire un Approvisionnement</a>
                         </li>
                         <li><a href="{{ route('admin.approvisionnements.index') }}">Liste des Approvisionnements</a>
                         </li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/expense1.svg') }}"
                             alt="img"><span> Stock</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.stocks.index') }}">Liste des Stocks</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/quotation1.svg') }}"
                             alt="img"><span> Factures</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.traitementventes.create') }}">Ajouter Factures</a></li>
                         <li><a href="{{ route('admin.facturesproduits.index') }}">Liste des Factures</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/time.svg') }}"
                             alt="img"><span> Rapport</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.inventaires.index') }}">Rapport Inventaire</a></li>
                         <li><a href="salesreport.html">Rapport Ventes</a></li>
                         <li><a href="purchasereport.html">Rapport Approvisionnement</a></li>
                         <li><a href="invoicereport.html">Rapport Facture</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/users1.svg') }}"
                             alt="img"><span> Tiers</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.clients.create') }}">Ajouter Clients</a></li>
                         <li><a href="{{ route('admin.clients.index') }}">Liste des Clients </a></li>
                         <li><a href="{{ route('admin.fournisseurs.create') }}">Ajouter Fournisseur</a></li>
                         <li><a href="{{ route('admin.fournisseurs.index') }}">Liste des Fournisseurs</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/users1.svg') }}"
                             alt="img"><span> Administrateur</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('admin.admins.create') }}">Nouveau Administrateur</a></li>
                         <li><a href="{{ route('admin.admins.index') }}">Liste administrateurs</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/settings.svg') }}"
                             alt="img"><span> Paramèttre</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="generalsettings.html">Paramèttre Général</a></li>
                         <li><a href="emailsettings.html">Paramèttre Email</a></li>
                         <li><a href="paymentsettings.html">Paramèttre Paiement</a></li>
                         <li><a href="currencysettings.html">Paramèttre Devise</a></li>
                         <li><a href="{{ route('admin.roles.index') }}">Rôles & Permissions</a></li>
                         <li><a href="taxrates.html">Tax Rates</a></li>
                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- End menu bar -->
 <!-- sidebar menu area end -->
