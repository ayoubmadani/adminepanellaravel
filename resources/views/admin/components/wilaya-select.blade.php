@props(['selected' => ''])

<select name="wilaya" required
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500']) }}>
    <option value="">-- اختر الولاية --</option>
    @php
        $wilayas = [
            'Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Béjaïa',
            'Biskra', 'Béchar', 'Blida', 'Bouira', 'Tamanrasset', 'Tébessa',
            'Tlemcen', 'Tiaret', 'Tizi Ouzou', 'Algiers', 'Djelfa', 'Jijel',
            'Sétif', 'Saïda', 'Skikda', 'Sidi Bel Abbès', 'Annaba', 'Guelma',
            'Constantine', 'Médéa', 'Mostaganem', 'MSila', 'Mascara', 'Ouargla',
            'Oran', 'El Bayadh', 'Illizi', 'Bordj Bou Arréridj', 'Boumerdès',
            'El Tarf', 'Tindouf', 'Tissemsilt', 'El Oued', 'Khenchela', 'Souk Ahras',
            'Tipaza', 'Mila', 'Aïn Defla', 'Naâma', 'Aïn Témouchent', 'Ghardaïa',
            'Relizane', 'Timimoun', 'Bordj Badji Mokhtar', 'Ouled Djellal', 'Beni Abbès',
            'In Salah', 'In Guezzam', 'Touggourt', 'Djanet', 'El Meghaier', 'El Meniaa'
        ];
    @endphp

    @foreach ($wilayas as $wilaya)
        <option value="{{ $wilaya }}" {{ $selected === $wilaya ? 'selected' : '' }}>
            {{ $wilaya }}
        </option>
    @endforeach
</select>
