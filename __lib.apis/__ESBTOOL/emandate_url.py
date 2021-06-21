import sys
import zeep
from zeep import xsd
from zeep.transports import Transport
from zeep import Client, xsd, Settings

bse_user = sys.argv[1].replace("\"", "")
#bse_fatca = sys.argv[2].replace("\"", "")
print(*bse_user)
'''print bse_user'''

LIVE = 1
MEMBERID = ['15133', '15133']
USERID = ['1513301', '1513303']
PASSWORD = ['456789!', '10101@']
#PASSWORD = ['456789!', '01010@']
PASSKEY = [ts,ts]

# url for BSEStar upload webservice which is used to do everything besides creating/cancelling 
# transactions like create user (transactions on bse can only be placed after this) etc
WSDL_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc?singleWsdl', 
    'https://bsestarmf.in/StarMFWebService/StarMFWebService.svc?wsdl'
]
SVC_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/MFUploadService/MFUploadService.svc/Secure', 
    'https://bsestarmf.in/StarMFWebService/StarMFWebService.svc/Secure'
]
METHOD_UPLOAD_URL = [
    'https://bsestarmfdemo.bseindia.com/2003/10/Serialization/',
    'https://bsestarmf.in/2003/10/Serialization/'
]

## fire SOAP query to create a new user on bsestar
def get_emandate_link(client, user_param, pass_dict):
    # method_url = METHOD_UPLOAD_URL[LIVE] + 'MFAPI'
    # header_value = soap_set_wsa_headers(method_url, SVC_UPLOAD_URL[LIVE])
    response = client.service.EMandateAuthURL(
        user_param[0],
        user_param[1],
        USERID[LIVE],
        PASSWORD[LIVE]
    )
    
    ## this is a good place to put in a slack alert

    response = response.split('|')
    status = response[0]
    if (status == '100'):
        link = response[1]
        return link
    else:
        raise Exception(
            "BSE error 644: E-Mandate Link not avialable: %s" % response[1]
        )



vasr = get_emandate_link(bse_user)
print(vasr)
