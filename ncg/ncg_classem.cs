using System;
using System.Collections.Generic;

namespace ngc
{
	public class classem
	{
		private string generated_code;
		public string class_name;
		public List<field> fields;


		public classem()
		{
			this.fields=new List<field>();
		}


		public string generate_code ()
		{
			this.generated_code = "class " + this.class_name + " \n{\n";

			this.generated_code+=generate_fields();
			this.generated_code+=generate_constructor();
			this.generated_code+=generate_new1();
			this.generated_code+=generate_new2();

			this.generated_code+="\n}";
			return this.generated_code;
		}

		protected string generate_fields ()
		{
			string generated_code="";
			foreach (field field in this.fields) {
				generated_code+="\t";
				switch(field.accesslevel)
				{
				case accessLevel.private_field:
					generated_code+= "private ";
					break;
				case accessLevel.public_field:
					generated_code+= "public ";
					break;
				case accessLevel.protected_field:
					generated_code+= "protected ";
					break;
				}
				generated_code+="var $"+field.name+";\n";
			}
			return generated_code;
		}

		protected string generate_constructor ()
		{
			string temp = "\n\tpublic function __construct()\n\t{";
			foreach (field field in this.fields) {
				if(field.defaultValue.Length>0)
				{
					temp+="\n\t\t$this->"+field.name+"="+field.defaultValue+";";
				}
			}
			temp+="\n\t}";
			return temp;
		}

		protected string generate_new1 ()
		{
			string temp = "\n\tpublic function new1(";
			int index=0;
			foreach (field f in fields) {
				if(index>0)
					temp+=" , ";
				temp+="$_"+f.name;
				index++;
			}
			temp+=")\n\t{";

			foreach (field field in this.fields) {
				temp+="\n\t\t$this->"+field.name+" = $_"+field+";";
			}
			temp+="\n\t}";
			return temp;
		}

		protected string generate_new2 ()
		{
			string temp = "\n\tpublic function new2(";
			temp += "$_id)\n\t{";

			temp += "\n\t\t$db = JFactory::getDBO();";
			temp += "\n\t\t$sql = 'select * from " + this.class_name + "_tbl where id = '.(int)$_id;";
			temp += "\n\t\t$db->setQuery((string)$sql);";
			temp += "\n\t\t$results = $db->loadObjectList();";

			temp += "\n\t\tif(count($results)<1)";
			temp += "\n\t\t\t$this->ID = -1;";
			temp += "\n\t\telse";
			temp += "\n\t\t{";

			temp+="\n\t\t\t$result = $results[0];";
			temp+="\n\t\t\t$this->ID =$result->id;\n";
			foreach (field f in this.fields) {
				temp+="\n\t\t\t$this->"+f.name+" = $result->"+f.name+";";
			}

			temp+="\n\t\t}";
			temp+="\n\t}";
			return temp;
		}

	}
}

