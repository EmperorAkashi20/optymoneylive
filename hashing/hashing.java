import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import javax.xml.bind.DatatypeConverter;

import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;


public class hashing {

	
	  public static void main (String args[]) throws InvalidKeyException, NoSuchAlgorithmException, IOException { 
		  //System.out.println("Hello World");

		  FileInputStream xml = new FileInputStream(args[0]); // new FileInputStream("C:/Users/Devmantra 10/eclipse-workspace/hashcoder/xml/BSJPB7947P_ITR-1_2018_N_8824.xml"); //
		  result = gethash(xml, 2072, "Y9DNS6keyczlRVr");
		  System.out.println(result);
	  }
	  
	public static final String ALGORITHM = "HmacSHA256";
	private static String result;
	public static String gethash(final InputStream is, final int iteration, final String key) throws IOException,
	NoSuchAlgorithmException, InvalidKeyException {
	Mac sha256_HMAC;
	sha256_HMAC = Mac.getInstance(ALGORITHM);
	final SecretKeySpec secret_key = new SecretKeySpec(key.getBytes(), ALGORITHM);
	sha256_HMAC.init(secret_key);
	byte[] bytesBuffer = new byte[2048];
	int bytesRead = -1;
	while ((bytesRead = is.read(bytesBuffer)) != -1) {
	sha256_HMAC.update(bytesBuffer, 0, bytesRead);
	}
	byte[] digestValue = sha256_HMAC.doFinal();
	for (int i = 0; i < iteration; i++) {
	sha256_HMAC.reset();
	digestValue = sha256_HMAC.doFinal(digestValue);
	}
	final String generatedHash = DatatypeConverter.printBase64Binary(digestValue); 
	return generatedHash;
	}
}
