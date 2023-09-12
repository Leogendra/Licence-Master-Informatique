import org.apache.jena.rdf.model.Model;
import org.apache.jena.rdf.model.ModelFactory;
import org.apache.jena.rdf.model.Property;
import org.apache.jena.rdf.model.Resource;
import org.apache.jena.rdf.model.Statement;
import org.apache.jena.vocabulary.DC;
import org.apache.jena.vocabulary.VCARD;
import org.apache.jena.vocabulary.XSD;

public class Main {
	public static void main(String args[]) {

		Model model = ModelFactory.createDefaultModel();
		
		Resource abbado
		  = model.createResource("https://example.com/Claudio_Abbado")
		  	.addProperty(VCARD.FN, "Claudio Abbado");
						
		Resource lso = model.createResource("https://example.com/Orchestre_Symphonique_de_Londres")
				.addProperty(U20, model.createResource("https://example.com/Orchestra"))
				.addProperty(DC.date, "1980");
				
		Property genre = m.createProperty("genre");
		Property enregistrement = m.createProperty("enregistrement");

		Resource jupiter = model.createResource("https://example.com/Symphony_41_Mozart")
				.addProperty(genre, model.createResource("https://example.com/Symphony"))
				.addProperty(enregistrement, lso);
		
		model.write(Systemodel.out, "RDF_Mozart");
	}
}
