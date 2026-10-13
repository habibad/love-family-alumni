<?php
/** Data fixture for frontend use only — NO fake identities. */
return [
  'executive' => [
    [ 'id' => 'exec-1', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
    [ 'id' => 'exec-2', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
    [ 'id' => 'exec-3', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
    [ 'id' => 'exec-4', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
  ],
  'trustees' => [
    [ 'id' => 'trustee-1', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
    [ 'id' => 'trustee-2', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
    [ 'id' => 'trustee-3', 'name' => null, 'role' => null, 'photo' => null, 'status' => 'pending' ],
  ],
  'committees' => [], // Fill only from client-confirmed committee data.
];
