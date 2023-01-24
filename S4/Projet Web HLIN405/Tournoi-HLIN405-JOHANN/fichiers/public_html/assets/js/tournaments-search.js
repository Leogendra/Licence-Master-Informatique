let filters = new Filters();

// ------------------------------------------------------------------------------------------------
// Création des différents inputs.

let enums = JSON.parse(window.localStorage.enums);
enums.comparator = {
    '=': 'égale à',
    '<': 'inférieure à',
    '<=': 'inférieure ou égale à',
    '>': 'supérieure à',
    '>=': 'supérieure ou égale à'
};
window.localStorage.enums = JSON.stringify(enums);

filters.addInput('name', {tag: 'input', type: 'text', class: 'form-control', name: 'name', id: 'name', placeholder: 'Nom d\'un tournoi (même incomplet)'});
filters.addInput('starting-date', {tag: 'div', class:'row', children: {
    div1: {tag: 'div', class: 'col-4', children: {
        select: {tag: 'select', class: 'form-select', name: 'starting-date-comparator', children: getEnumOptionObject('comparator', true)}
    }},
    div2: {tag: 'div', class: 'col-8', children: {
        input: {tag: 'input', type: 'date', class: 'form-control', name: 'starting-date', id: 'starting-date', value: new Date().formatString()}
    }}
}});
filters.addInput('ending-date', {tag: 'div', class:'row', children: {
    div1: {tag: 'div', class: 'col-4', children: {
        select: {tag: 'select', class: 'form-select', name: 'ending-date-comparator', children: getEnumOptionObject('comparator', true)}
    }},
    div2: {tag: 'div', class: 'col-8', children: {
        input: {tag: 'input', type: 'date', class: 'form-control', name: 'ending-date', id: 'ending-date', value: new Date().formatString()}
    }}
}});
filters.addInput('duration', {tag: 'div', class:'row', children: {
    div1: {tag: 'div', class: 'col-4', children: {
        select: {tag: 'select', class: 'form-select', name: 'duration-comparator', children: getEnumOptionObject('comparator', true)}
    }},
    div2: {tag: 'div', class: 'col-8', children: {
        input: {tag: 'input', type: 'number', class: 'form-control', name: 'duration', id: 'duration', min: 1, max: 30, value: 1} 
    }}
}});
filters.addInput('type', {tag: 'select', class: 'form-select', name: 'type', children: getEnumOptionObject('type', false, ['1', '2'])});
filters.addInput('department', {tag: 'input', type: 'text', name: 'department', class: 'form-control', pattern: '\\d{2}', placeholder: '75'});
filters.addInput('city', {tag: 'input', type: 'text', name: 'city', class: 'form-control', placeholder: 'Une ville...'});
filters.addInput('status', {tag: 'select', class: 'form-select', name: 'status', children: getEnumOptionObject('status')});
filters.addInput('manager', {tag: 'select', class: 'form-select', name: 'manager', children: getEnumOptionObject('manager', true)});

let values = window.localStorage.searchData;

if ('undefined' === typeof values || 0 === values.length) {
    filters.addFilter();
}
else {
    values = JSON.parse(values);
    for (valueKey in values) {
        if (Array.isArray(values[valueKey])) {
            values[valueKey].forEach((value) => {
                filters.setFilterValue(valueKey, value);
            });
        }
        else  {
            filters.setFilterValue(valueKey, values[valueKey]);
        }
        filters.addFilter(valueKey);
    }
}