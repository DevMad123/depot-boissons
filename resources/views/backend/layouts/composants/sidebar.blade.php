 <!-- sidebar menu area start -->
 <!-- Menu bar -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar" id="sidebar">
     <div class="sidebar-inner slimscroll">
         <div id="sidebar-menu" class="sidebar-menu">
             <ul>

                 <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                     <a href="{{ route('admin.dashboard') }}"><img
                             src="{{ asset('backend/assets/img/icons/dashboard.svg') }}" alt="img"><span> Tableau
                             de
                             bord</span> </a>
                 </li>
                 @if (
                    $usr->can('journees.create') ||
                    $usr->can('journees.view') ||
                    $usr->can('journees.edit') ||
                    $usr->can('journees.delete')
                )
                <li
                    class="submenu {{ Route::is('admin.journees.index') ? 'in' : '' }}">
                    <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/product.svg') }}"
                            alt="img"><span> Journées</span> <span class="menu-arrow"></span></a>
                    <ul>
                        @if ($usr->can('journees.view'))
                            <li>
                                <a class="{{ Route::is('admin.journees.index') ? 'active' : '' }}"
                                    href="{{ route('admin.journees.index') }}">Liste des Journées</a>
                            </li>
                        @endif
                        @if ($usr->can('journees.view'))
                            <li>
                                <a class="{{ Route::is('admin.operations.index') ? 'active' : '' }}"
                                    href="{{ route('admin.operations.index') }}">Opérations de la journée</a>
                            </li>
                            <li>
                                <a class="{{ Route::is('admin.operations.create') ? 'active' : '' }}"
                                    href="{{ route('admin.operations.create') }}">Toutes les opérations</a>
                            </li>
                        @endif
                    </ul>
                </li>
                 @endif

                 @if (
                     $usr->can('produit.create') ||
                         $usr->can('produit.view') ||
                         $usr->can('produit.edit') ||
                         $usr->can('produit.delete') ||
                         $usr->can('emballage.create') ||
                         $usr->can('emballage.view') ||
                         $usr->can('emballage.edit') ||
                         $usr->can('emballage.delete') ||
                         $usr->can('format.create') ||
                         $usr->can('format.view') ||
                         $usr->can('format.edit') ||
                         $usr->can('format.delete') ||
                         $usr->can('type_produit.create') ||
                         $usr->can('type_produit.view') ||
                         $usr->can('type_produit.edit') ||
                         $usr->can('type_produit.delete'))
                     <li
                         class="submenu {{ Route::is('admin.produits.create') || Route::is('admin.produits.index') || Route::is('admin.emballages.create') || Route::is('admin.emballages.index') || Route::is('admin.tailles.create') || Route::is('admin.tailles.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/product.svg') }}"
                                 alt="img"><span> Produit</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('produit.create'))
                                 <li><a class="{{ Route::is('admin.produits.create') ? 'active' : '' }}"
                                         href="{{ route('admin.produits.create') }}">Ajouter Produit</a></li>
                             @endif
                             @if ($usr->can('produit.view'))
                                 <li><a class="{{ Route::is('admin.produits.index') ? 'active' : '' }}"
                                         href="{{ route('admin.produits.index') }}">Liste des Produits</a></li>
                             @endif
                             @if ($usr->can('emballage.create'))
                                 <li><a class="{{ Route::is('admin.emballages.create') ? 'active' : '' }}"
                                         href="{{ route('admin.emballages.create') }}">Ajouter Emballage</a></li>
                             @endif
                             @if ($usr->can('emballage.view'))
                                 <li><a class="{{ Route::is('admin.emballages.index') ? 'active' : '' }}"
                                         href="{{ route('admin.emballages.index') }}">Liste des Emballages</a></li>
                             @endif
                             @if ($usr->can('format.create'))
                                 <li><a class="{{ Route::is('admin.tailles.create') ? 'active' : '' }}"
                                         href="{{ route('admin.tailles.create') }}">Ajouter Format</a></li>
                             @endif
                             @if ($usr->can('format.view'))
                                 <li><a class="{{ Route::is('admin.tailles.index') ? 'active' : '' }}"
                                         href="{{ route('admin.tailles.index') }}">Liste Formats</a></li>
                             @endif
                             @if ($usr->can('type_produit.create'))
                                 <li><a class="{{ Route::is('admin.typeproduits.create') ? 'active' : '' }}"
                                         href="{{ route('admin.typeproduits.create') }}">Ajouter type produit</a></li>
                             @endif
                             @if ($usr->can('type_produit.view'))
                                 <li><a class="{{ Route::is('admin.typeproduits.index') ? 'active' : '' }}"
                                         href="{{ route('admin.typeproduits.index') }}">Liste types produits</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif


                 @if (
                     $usr->can('ventes.create') ||
                         $usr->can('ventes.view') ||
                         $usr->can('listeventes.view') ||
                         $usr->can('detailventes.view'))
                     <li
                         class="submenu {{ Route::is('admin.listeventes.index') || Route::is('admin.traitementventeclients.create') || Route::is('admin.ventes.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/sales1.svg') }}"
                                 alt="img"><span> Ventes</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('ventes.create'))
                                 <li><a class="{{ Route::is('admin.traitementventeclients.create') ? 'active' : '' }}"
                                         href="{{ route('admin.traitementventeclients.create') }}">Nouvelle Vente</a>
                                 </li>
                             @endif
                             @if ($usr->can('listeventes.view'))
                                 <li><a class="{{ Route::is('admin.listeventes.index') ? 'active' : '' }}"
                                         href="{{ route('admin.listeventes.index') }}">Liste des Ventes</a></li>
                             @endif
                             @if ($usr->can('detailventes.view'))
                                 <li><a class="{{ Route::is('admin.ventes.index') ? 'active' : '' }}"
                                         href="{{ route('admin.ventes.index') }}">Liste détails Ventes</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif



                 @if (
                     $usr->can('approvisionnement.create') ||
                         $usr->can('approvisionnement.view') ||
                         $usr->can('approvisionnement.edit') ||
                         $usr->can('approvisionnement.delete'))
                     <li
                         class="submenu {{ Route::is('admin.approvisionnements.create') || Route::is('admin.approvisionnements.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img
                                 src="{{ asset('backend/assets/img/icons/quotation1.svg ') }}" alt="img"><span>
                                 Approvisionnement</span> <span class="menu-arrow"></span></a>
                         <ul>

                             @if ($usr->can('approvisionnement.create'))
                                 <li><a class="{{ Route::is('admin.approvisionnements.create') ? 'active' : '' }}"
                                         href="{{ route('admin.approvisionnements.create') }}">Faire un
                                         Approvisionnement</a>
                                 </li>
                             @endif
                             @if ($usr->can('approvisionnement.view'))
                                 <li><a class="{{ Route::is('admin.approvisionnements.index') ? 'active' : '' }}"
                                         href="{{ route('admin.approvisionnements.index') }}">Liste des
                                         Approvisionnements</a>
                                 </li>
                             @endif
                         </ul>
                     </li>
                 @endif



                 @if ($usr->can('stock.create') || $usr->can('stock.view') || $usr->can('stock.edit') || $usr->can('stock.delete'))
                     <li class="submenu {{ Route::is('admin.stock.create') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/expense1.svg') }}"
                                 alt="img"><span> Stock</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('stock.view'))
                                 <li><a class="{{ Route::is('admin.stocks.index') ? 'active' : '' }}"
                                         href="{{ route('admin.stocks.index') }}">Liste des Stocks</a></li>
                             @endif
                         </ul>

                     </li>
                 @endif




                 @if ($usr->can('listefacturesliquide.view') || $usr->can('listefacturesemballage.view'))
                     <li
                         class="submenu {{ Route::is('admin.factureembss.index') || Route::is('admin.factures.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/purchase1.svg') }}"
                                 alt="img"><span> Factures</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('listefacturesliquide.view'))
                                 <li><a class="{{ Route::is('admin.factures.index') ? 'active' : '' }}"
                                         href="{{ route('admin.factures.index') }}">Liste des Factures Liq.</a></li>
                             @endif
                             @if ($usr->can('listefacturesemballage.view'))
                                 <li><a class="{{ Route::is('admin.factureembss.index') ? 'active' : '' }}"
                                         href="#">Liste des Factures Emb.</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif



                 @if (
                     $usr->can('rapportinventaire.view') ||
                         $usr->can('rapportventes.view') ||
                         $usr->can('rapportapprovisionnement.view') ||
                         $usr->can('rapportfacture.view'))

                     <li
                         class="submenu {{ Route::is('admin.traitementventeclients.create') || Route::is('admin.traitementventeclients.index') || Route::is('admin.listeventes.create') || Route::is('admin.listeventes.index') || Route::is('admin.ventes.create') || Route::is('admin.ventes.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/time.svg') }}"
                                 alt="img"><span> Rapport</span> <span class="menu-arrow"></span></a>
                         <ul>
                             {{-- @if ($usr->can('rapportinventaire.view'))
                                 <li><a class="{{ Route::is('admin.typeproduits.index') ? 'active' : '' }}"
                                         href="{{ route('admin.inventaires.index') }}">Rapport Inventaire</a></li>
                             @endif --}}
                             @if ($usr->can('rapportventes.view'))
                                 <li><a class="{{ Route::is('admin.typeproduits.index') ? 'active' : '' }}"
                                         href="#">Rapport Ventes</a></li>
                             @endif
                             @if ($usr->can('rapportapprovisionnement.view'))
                                 <li><a class="{{ Route::is('admin.typeproduits.index') ? 'active' : '' }}"
                                         href="#">Rapport Approvisionnement</a></li>
                             @endif
                             @if ($usr->can('rapportfacture.view'))
                                 <li><a class="{{ Route::is('admin.typeproduits.index') ? 'active' : '' }}"
                                         href="#">Rapport Facture</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif


                 @if (
                     $usr->can('client.create') ||
                         $usr->can('client.view') ||
                         $usr->can('client.edit') ||
                         $usr->can('client.delete') ||
                         $usr->can('fournisseur.create') ||
                         $usr->can('fournisseur.view') ||
                         $usr->can('fournisseur.edit') ||
                         $usr->can('fournisseur.delete'))
                     <li
                         class="submenu {{ Route::is('admin.clients.create') || Route::is('admin.clients.index') || Route::is('admin.fournisseurs.create') || Route::is('admin.fournisseurs.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/users1.svg') }}"
                                 alt="img"><span> Tiers</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('client.create'))
                                 <li><a class="{{ Route::is('admin.clients.create') ? 'active' : '' }}"
                                         href="{{ route('admin.clients.create') }}">Ajouter Clients</a></li>
                             @endif
                             @if ($usr->can('client.view'))
                                 <li><a class="{{ Route::is('admin.clients.index') ? 'active' : '' }}"
                                         href="{{ route('admin.clients.index') }}">Liste des Clients </a></li>
                             @endif
                             @if ($usr->can('fournisseur.create'))
                                 <li><a class="{{ Route::is('admin.fournisseurs.create') ? 'active' : '' }}"
                                         href="{{ route('admin.fournisseurs.create') }}">Ajouter Fournisseur</a></li>
                             @endif
                             @if ($usr->can('fournisseur.view'))
                                 <li><a class="{{ Route::is('admin.fournisseurs.index') ? 'active' : '' }}"
                                         href="{{ route('admin.fournisseurs.index') }}">Liste des Fournisseurs</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif




                 @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                     <li
                         class="submenu {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/users1.svg') }}"
                                 alt="img"><span> Administrateur</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('admin.create'))
                                 <li><a class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"
                                         href="{{ route('admin.admins.create') }}">Nouveau Administrateur</a></li>
                             @endif
                             @if ($usr->can('admin.view'))
                                 <li><a class="{{ Route::is('admin.admins.index') ? 'active' : '' }}"
                                         href="{{ route('admin.admins.index') }}">Liste administrateurs</a></li>
                             @endif
                         </ul>
                     </li>
                 @endif



                 @if (
                     $usr->can('general.create') ||
                         $usr->can('general.view') ||
                         $usr->can('general.edit') ||
                         $usr->can('general.delete'))
                     <li
                         class="submenu {{ Route::is('admin.paramgenerals.index') || Route::is('admin.parammodepaiements.index') || Route::is('admin.devises.index') || Route::is('admin.roles.index') || Route::is('admin.tvas.index') || Route::is('admin.fraisairsis.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img
                                 src="{{ asset('backend/assets/img/icons/settings.svg') }}" alt="img"><span>
                                 Paramèttre</span> <span class="menu-arrow"></span></a>
                         <ul>
                             @if ($usr->can('general.view'))
                                 <li><a class="{{ Route::is('admin.paramgenerals.index') ? 'active' : '' }}"
                                         href="{{ route('admin.paramgenerals.index') }}">Paramèttre Général</a></li>
                             @endif
                             @if ($usr->can('mode_paiement.view'))
                                 <li><a class="{{ Route::is('admin.parammodepaiements.index') ? 'active' : '' }}"
                                         href="{{ route('admin.parammodepaiements.index') }}">Paramèttre Mode de
                                         Paiement</a>
                                 </li>
                             @endif
                             @if ($usr->can('devise.view'))
                                 <li><a class="{{ Route::is('admin.devises.index') ? 'active' : '' }}"
                                         href="{{ route('admin.devises.index') }}">Paramèttre Devise</a></li>
                             @endif
                             @if ($usr->can('role.view'))
                                 <li><a class="{{ Route::is('admin.roles.index') ? 'active' : '' }}"
                                         href="{{ route('admin.roles.index') }}">Rôles & Permissions</a></li>
                             @endif
                             @if ($usr->can('tva.view'))
                                 <li><a class="{{ Route::is('admin.tvas.index') ? 'active' : '' }}"
                                         href="{{ route('admin.tvas.index') }}">Paramèttre Tva</a></li>
                             @endif
                             @if ($usr->can('fraisairsi.view'))
                                 <li><a class="{{ Route::is('admin.fraisairsis.index') ? 'active' : '' }}"
                                         href="{{ route('admin.fraisairsis.index') }}">Paramèttre Frais AIRSI</a></li>
                             @endif

                         </ul>
                     </li>
                 @endif


                 @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') || $usr->can('role.delete'))
                     <li
                         class="submenu {{ Route::is('admin.seuilcritiques.index') || Route::is('admin.tariftypeproduitclients.index') || Route::is('admin.tariftypeproduitfournisseurs.index') || Route::is('admin.tariftypeproduitembclients.index') || Route::is('admin.typeclients.index') ? 'in' : '' }}">
                         <a href="javascript:void(0);"><img
                                 src="{{ asset('backend/assets/img/icons/settings.svg') }}" alt="img"><span>
                                 Autres Paramèttre</span> <span class="menu-arrow"></span></a>
                         <ul>

                             @if ($usr->can('seuilcritique.view'))
                                 <li><a class="{{ Route::is('admin.seuilcritiques.index') ? 'active' : '' }}"
                                         href="{{ route('admin.seuilcritiques.index') }}">Seuil Critique</a></li>
                             @endif

                             @if ($usr->can('tariftypeproduitclient.view'))
                                 <li><a class="{{ Route::is('admin.tariftypeproduitclients.index') ? 'active' : '' }}"
                                         href="{{ route('admin.tariftypeproduitclients.index') }}">Tarif Type Produit
                                         Clients</a></li>
                             @endif

                             @if ($usr->can('tariftypeproduitfournisseur.view'))
                                 <li><a class="{{ Route::is('admin.tariftypeproduitfournisseurs.index') ? 'active' : '' }}"
                                         href="{{ route('admin.tariftypeproduitfournisseurs.index') }}">Tarif Type
                                         Produit
                                         Fournisseurs</a></li>
                             @endif

                             @if ($usr->can('tariftypeproduitembclient.view'))
                                 <li><a class="{{ Route::is('admin.tariftypeproduitembclients.index') ? 'active' : '' }}"
                                         href="{{ route('admin.tariftypeproduitembclients.index') }}">Tarif Type
                                         Produit
                                         Emb.
                                         Clients</a></li>
                             @endif

                             @if ($usr->can('typeclient.view'))
                                 <li><a class="{{ Route::is('admin.typeclients.index') ? 'active' : '' }}"
                                         href="{{ route('admin.typeclients.index') }}">Type Client</a></li>
                             @endif

                         </ul>
                     </li>
                 @endif
             </ul>
         </div>
     </div>
 </div>
 <!-- End menu bar -->
 <!-- sidebar menu area end -->
