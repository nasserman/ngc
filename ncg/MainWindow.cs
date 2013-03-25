using System;
using Gtk;
using System.Xml;
using System.IO;



public partial class MainWindow: Gtk.Window
{	
	public MainWindow (): base (Gtk.WindowType.Toplevel)
	{
		Build ();
		//readXML();
		generate_code();
	}
	
	protected void OnDeleteEvent (object sender, DeleteEventArgs a)
	{
		Application.Quit ();
		a.RetVal = true;
	}

	protected void generate_code ()
	{
		ngc.classem n = new ngc.classem();
		ngc.field f =new ngc.field();
		f.accesslevel=ngc.accessLevel.public_field;
		f.defaultValue="''";
		f.name="field1";
		n.fields.Add (f);
			
		ngc.field f2= new ngc.field();
		f2.accesslevel=ngc.accessLevel.protected_field;
		f2.name="name";
		f2.defaultValue="'no name'";
		n.fields.Add (f2);

		string s = n.generate_code();
		this.label1.Text=s;




	}

	private void readXML ()
	{
		string fileName = "/home/nasser/Desktop/ncg/ncg/sampledata.xml";
		if (File.Exists (fileName)) {

			XmlTextReader xreader = new XmlTextReader(fileName);
			label1.Text="";
			while(xreader.Read ())
			{
				if(xreader.NodeType==XmlNodeType.Element)
				{
					xreader.Read();
					if(xreader.NodeType==XmlNodeType.Text)
					{
					}
				}
				/*label1.Text+="\nnode type :\t"+xreader.NodeType.ToString ();
				label1.Text+="\nname : \t\t"+xreader.Name;
				label1.Text+="\nvalue :\t\t"+xreader.Value;
				label1.Text+="\n-----------------";*/
			}
			
			//label1.Text+="\n"+xreader.GetAttribute("version").ToString ();
		}
		else 
			label1.Text="file not exists";
		
	}


}
