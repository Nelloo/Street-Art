{
	
	if(NR==nb-1) {
		printf("}\n");
		printf("  public function execute%s() {\n",nom);
		printf("}\n");
	} else {
		printf("%s\n",$0);
	}
}
