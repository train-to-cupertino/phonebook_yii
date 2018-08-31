class Phone {
	constructor() {	
		this.number = "";
	}
}

class Contact {
	constructor(tableRowTag) {	
		this.name = "";
		this.phones = [];
		this.tableRowTag = tableRowTag;
	}

	// Сменить наименование контакта
	changeName(newName) {
		this.name = newName;
	}
	
	// Добавить номер телефона
	addPhone(newPhone) {
		if (newPhone instanceof Phone) {
			this.phones.push(newPhone);
		} else {
			alert("Добавляемый номер не является номером телефона");
		}
	}
}

class App {
	constructor() {
		this.contactList = [];
	}
	
	findContact(text) {

	}

}

$(document).ready(function() {
	let app = new App();	
});

/*

	  //}
//*/