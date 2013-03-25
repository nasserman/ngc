using System;

namespace ngc
{
	public class field
	{
		public field (){}
		public accessLevel accesslevel;
		public string defaultValue;
		public string name;

	}

	public enum accessLevel{ public_field,private_field,protected_field };
}

